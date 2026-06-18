<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RescheduleRequest;

class RescheduleRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'requested_date' => 'required|date',
            'requested_time' => 'nullable|date_format:H:i',
            'reason'         => 'nullable|string'
        ]);

        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $reschedule = RescheduleRequest::create([
            'user_id'        => $user->id,
            'requested_date' => $request->requested_date,
            'requested_time' => $request->requested_time,
            'reason'         => $request->reason,
            'status'         => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan Reschedule berhasil dikirim. Admin akan segera menghubungi Anda.',
            'data'    => $reschedule
        ], 201);
    }
}
