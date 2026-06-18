<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProgress;

class UserProgressController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $progress = UserProgress::where('user_id', $user->id)->first();
        
        if (!$progress) {
            return response()->json(['message' => 'Progress not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $progress
        ]);
    }
}
