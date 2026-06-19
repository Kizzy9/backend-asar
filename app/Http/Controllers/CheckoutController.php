<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ClassRegistration;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'umur' => 'required|integer',
            'nomor_whatsapp' => 'required|string',
            'package_name' => 'required|string',
            'amount' => 'required|numeric'
        ]);

        $orderId = 'ASAR-' . strtoupper(Str::random(10));
        $email = strtolower(str_replace(' ', '', $validated['nama_lengkap'])) . rand(10,99) . '@asar.com';

        $transaction = Transaction::create([
            'order_id' => $orderId,
            'user_name' => $validated['nama_lengkap'],
            'user_email' => $email,
            'package_name' => $validated['package_name'],
            'gross_amount' => $validated['amount'],
            'status' => 'pending'
        ]);

        // Simpan pendaftaran ke ClassRegistration untuk rekam manual jika diperlukan
        ClassRegistration::create([
            'package_name' => $validated['package_name'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'umur' => $validated['umur'],
            'nomor_whatsapp' => $validated['nomor_whatsapp'],
            'status' => 'pending'
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $validated['amount'],
            ],
            'customer_details' => [
                'first_name' => $validated['nama_lengkap'],
                'email' => $email,
                'phone' => $validated['nomor_whatsapp'],
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $transaction->update(['snap_token' => $snapToken]);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            if ($transaction) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $transaction->update(['status' => 'success', 'payment_type' => $request->payment_type]);
                    
                    // Auto Create User Account and Progress
                    $user = User::firstOrCreate(
                        ['email' => $transaction->user_email],
                        [
                            'name' => $transaction->user_name,
                            'username' => strtolower(explode(' ', $transaction->user_name)[0]) . rand(100,999),
                            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                            'role' => 'member'
                        ]
                    );

                    UserProgress::firstOrCreate(
                        ['user_id' => $user->id],
                        [
                            'current_level' => 'HBA Pemula',
                            'progress_percent' => 0,
                            'skills' => [
                                ['name' => 'Pengenalan Kuda', 'status' => 'active']
                            ],
                            'coach_name' => 'Menunggu Jadwal'
                        ]
                    );
                } elseif ($request->transaction_status == 'expire') {
                    $transaction->update(['status' => 'expired']);
                } elseif ($request->transaction_status == 'cancel' || $request->transaction_status == 'deny') {
                    $transaction->update(['status' => 'failed']);
                }
            }
        }

        return response()->json(['success' => true]);
    }
}
