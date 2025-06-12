<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\{AbsenController, DashboardController, ProfileController, MemberController};
use App\Http\Controllers\ScanQRController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/scan-qr', [ScanQRController::class, 'index'])->name('scan');
Route::post('/scan', [ScanQRController::class, 'validasi'])->name('validasiqr');

// dashboard
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

// profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'profile_update'])->name('profile.update');

// absen
Route::get('/absen-member', [AbsenController::class, 'hadir'])->name('absensi.index');
Route::get('/absen-member/tidak-hadir', [AbsenController::class, 'belumAbsen'])->name('absensi.belum_absen');
Route::get('/absen-member/semua', [AbsenController::class, 'semua'])->name('absensi.semua');
Route::put('/absen-member/edit', [AbsenController::class, 'editAbsensi'])->name('absensi.edit');


//data member
Route::get('/admin/member/index', [MemberController::class, 'index'])->name('members.index');
Route::post('/admin/member', [MemberController::class, 'store'])->name('members.store');
Route::put('admin/members/{id}', [MemberController::class, 'update'])->name('members.update');
Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
Route::get('/members/{id}/generate-download-qr', [MemberController::class, 'generateAndDownloadQr'])->name('members.generateDownloadQr');
