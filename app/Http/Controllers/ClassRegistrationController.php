<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Support\Facades\Hash;

class ClassRegistrationController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari Vue
        $validated = $request->validate([
            'package_name'    => 'required|string',
            'nama_lengkap'    => 'required|string|max:255',
            'umur'            => 'required|numeric',
            'tempat_lahir'    => 'nullable|string',
            'tanggal_lahir'   => 'nullable|date',
            'email'           => 'required|email',
            'username'        => 'required|string|unique:users,username',
            'nomor_whatsapp'  => 'required|string',
            'alamat_domisili' => 'nullable|string',
            'password'        => 'required|string|min:6',
            'coach'           => 'required|string',
            'pengalaman'      => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            // 1. Simpan Pendaftaran Kelas
            $registrationId = DB::table('class_registrations')->insertGetId([
                'package_name'    => $validated['package_name'],
                'nama_lengkap'    => $validated['nama_lengkap'],
                'umur'            => $validated['umur'],
                'tempat_lahir'    => $validated['tempat_lahir'],
                'nomor_whatsapp'  => $validated['nomor_whatsapp'],
                'alamat_domisili' => $validated['alamat_domisili'],
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);

            // 2. Buat Akun Member (User)
            $user = User::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['nama_lengkap'],
                    'username' => $validated['username'],
                    'password' => Hash::make($validated['password']),
                ]
            );

            // Jika user sudah ada (password tidak diubah oleh firstOrCreate), kita bisa opsional mengupdate password
            if (!$user->wasRecentlyCreated) {
                $user->password = Hash::make($validated['password']);
                $user->save();
            }

            // 3. Buat Progress Belajar
            $level = $validated['pengalaman'] === 'Senior' ? 'Senior' : 'HBA Pemula (Tahap 1)';
            $initialSkills = [
                ['name' => 'Pengenalan & Bonding Kuda', 'status' => 'active'],
                ['name' => 'Keseimbangan Dasar (Walk)', 'status' => 'locked'],
                ['name' => 'Postur Posting Trot', 'status' => 'locked'],
                ['name' => 'Teknik Panahan Bawah', 'status' => 'locked']
            ];

            if ($validated['pengalaman'] === 'Senior') {
                $initialSkills = [
                    ['name' => 'Canter Dasar', 'status' => 'active'],
                    ['name' => 'Fast Trot Panahan', 'status' => 'locked']
                ];
            }

            UserProgress::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'current_level' => $level,
                    'progress_percent' => 0,
                    'skills' => $initialSkills,
                    'coach_name' => $validated['coach'],
                    'instructor_note' => 'Selamat datang di Asar Stable! Mari kita mulai latihan perdana Anda.',
                    'note_date' => now()
                ]
            );

            DB::commit();
            return response()->json(['message' => 'Pendaftaran berhasil dan Akun Member telah dibuat!'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal mendaftar: ' . $e->getMessage()], 500);
        }
    }
}