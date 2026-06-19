<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProgress;
use App\Models\RescheduleRequest;
use App\Models\Transaction;
use App\Models\ClassRegistration;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getMembers()
    {
        $members = User::where('role', 'member')->with('progress')->get();
        return response()->json([
            'success' => true,
            'data' => $members
        ]);
    }

    public function updateProgress(Request $request, $id)
    {
        $validated = $request->validate([
            'current_level' => 'sometimes|string',
            'progress_percent' => 'sometimes|integer',
            'skills' => 'sometimes|array',
            'coach_name' => 'sometimes|string',
            'instructor_note' => 'sometimes|string',
            'next_schedule_date' => 'sometimes|date|nullable',
            'next_schedule_time' => 'sometimes|string|nullable'
        ]);

        $progress = UserProgress::updateOrCreate(
            ['user_id' => $id],
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Progress updated successfully',
            'data' => $progress
        ]);
    }

    public function getReschedules()
    {
        $requests = RescheduleRequest::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $requests
        ]);
    }

    public function updateReschedule(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $reschedule = RescheduleRequest::findOrFail($id);
        $reschedule->status = $validated['status'];
        $reschedule->save();

        if ($validated['status'] === 'approved') {
            UserProgress::updateOrCreate(
                ['user_id' => $reschedule->user_id],
                ['next_schedule_date' => $reschedule->requested_date]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Reschedule ' . $validated['status']
        ]);
    }

    public function getDashboardStats()
    {
        $totalMembers = User::where('role', 'member')->count();
        $totalRevenue = Transaction::where('status', 'success')->sum('gross_amount');
        $successfulTransactions = Transaction::where('status', 'success')->count();
        
        return response()->json([
            'success' => true,
            'data' => [
                'total_members' => $totalMembers,
                'total_revenue' => $totalRevenue,
                'successful_transactions' => $successfulTransactions
            ]
        ]);
    }

    public function getTransactions()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    public function getRegistrations()
    {
        $registrations = ClassRegistration::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $registrations
        ]);
    }
}
