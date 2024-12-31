<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\JadwalKerjaController;
use App\Http\Controllers\Pegawai\JadwalKuliahController;

Route::get('/', function () {
    return "ini akan menjadi halaman katalog produk untuk customer";
});

Route::get('/admin', function () {
    return redirect()->route('login');
});

Route::middleware("auth")->group(function () {
    Route::view("/admin/akun", "manajer/akun")->name("account");
    Route::view("/admin", "manajer/dashboard")->name("dashboard");
    Route::view("/admin/catalog", "manajer/katalog")->name("catalog");
    Route::view("admin/jadwalkuliah", "manajer/jadwalkuliah")->name("jadwalkuliah");
    Route::view("admin/jadwalpegawai", "manajer/jadwalpegawai")->name("jadwalpegawai");

    Route::view("pegawai/penjadwalan", "pegawai/penjadwalan")->name("penjadwalan");
    Route::view("pegawai/profile", "pegawai/profile")->name("profile");
    Route::view("pegawai/jadwal", "pegawai/jadwal")->name("jadwalpegawai");
    Route::view("pegawai/rekapkehadiran", "pegawai/rekapkehadiran")->name("kehadiran");
});

Route::post('pegawai/penjadwalan', [JadwalKuliahController::class, 'store'])->name('penjadwalan.store');
Route::get('admin/jadwalkuliah', [JadwalKuliahController::class, 'index'])->name('jadwalkuliah.index');
Route::post('admin/jadwalkuliah', [JadwalKerjaController::class, 'buatJadwal'])->name('jadwalKerja.buat');

Route::get('admin/jadwalpegawai', [PresensiController::class, 'index'])->name('jadwalpegawai.index');
Route::post('admin/jadwalpegawai', [PresensiController::class, 'savePresence'])->name('jadwalpegawai.savePresence');

Route::get('pegawai/rekapkehadiran', [PresensiController::class, 'rekapKehadiran'])->name('rekapkehadiran');
Route::post('pegawai/jadwal', [JadwalKerjaController::class, 'index'])->name('jadwalkerja.index');


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
