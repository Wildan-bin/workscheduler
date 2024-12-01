<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalKerjaController;
use App\Http\Controllers\Pegawai\JadwalKuliahController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware("auth")->group(function () {
    Route::view("/admin", "manajer/dashboard")->name("dashboard");
    Route::view("/admin/catalog", "manajer/katalog")->name("catalog");
    Route::view("/admin/akun", "manajer/akun")->name("account");
    Route::view("pegawai/penjadwalan", "pegawai/penjadwalan")->name("penjadwalan");
});

Route::view("admin/jadwal", "manajer/jadwal")->name("jadwalpegawai");
Route::view("admin/jadwalkuliah", "manajer/jadwalkuliah")->name("jadwalkuliah");

// 
Route::post('pegawai/penjadwalan', [JadwalKuliahController::class, 'store'])->name('penjadwalan.store');
Route::get('admin/jadwalkuliah', [JadwalKuliahController::class, 'index'])->name('jadwalkuliah.index');
Route::post('admin/jadwalkuliah', [JadwalKerjaController::class, 'buatJadwal'])->name('jadwalKerja.buat');



Route::get("/login", [AuthController::class, "login"])
    ->name("login");
Route::post("/login", [AuthController::class, "loginPost"])
    ->name("login.post");

Route::get("/register", [AuthController::class, "register"])
    ->name("register");
Route::post("/register", [AuthController::class, "registerPost"])
    ->name("register.post");

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
