<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassPackageController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ClassRegistrationController;
use App\Http\Controllers\EquestrianTheoryController;
use App\Http\Controllers\TourPackageController;

/*
|--------------------------------------------------------------------------
| API Routes Asar Stable
|--------------------------------------------------------------------------
*/

// ==========================================================
// 1. RUTE PUBLIK (Tidak Perlu Token)
// ==========================================================
Route::get('/tes-baru', [TestController::class, 'cekStatus']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/classes', [ClassPackageController::class, 'index']);
Route::get('/tour-packages', [TourPackageController::class, 'index']);

Route::post('/register-class', [ClassRegistrationController::class, 'store']);


// ==========================================================
// 2. RUTE TERKUNCI (Wajib Bawa Token Sanctum)
// ==========================================================
Route::middleware('auth:sanctum')->group(function () {
    
    // User Management
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // Class Management
    Route::post('/classes', [ClassPackageController::class, 'store']);
    Route::put('/classes/{class}', [ClassPackageController::class, 'update']);
    Route::delete('/classes/{class}', [ClassPackageController::class, 'destroy']);

    // Equestrian Theory Modules
    // Sesuai dengan permintaan, rute ini dipanggil oleh frontend sebagai '/teori'
    // Saya buatkan alias agar aplikasi Anda tidak error saat memanggil API
    Route::get('/equestrian-theories', [EquestrianTheoryController::class, 'index']);
    Route::get('/teori', [EquestrianTheoryController::class, 'index']);

    // Progress & Reschedule
    Route::get('/user-progress', [\App\Http\Controllers\UserProgressController::class, 'index']);
    Route::post('/reschedule', [\App\Http\Controllers\RescheduleRequestController::class, 'store']);

});