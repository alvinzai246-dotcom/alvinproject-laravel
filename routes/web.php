<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\VerifyEmailController; // TAMBAH INI
use Illuminate\Http\Request;

// Halaman awal redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('daftar');
    Route::post('/daftar', [AuthController::class, 'register'])->name('daftar.post');
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Route verifikasi email - GANTI BAGIAN INI
Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Halaman "Cek email lu bro"
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Route kirim ulang verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi udah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Auth only - HARUS LOGIN + VERIFIED
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('/mahasiswa/export-excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.export.excel');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});