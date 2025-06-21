<?php

use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\VariasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\JadwalKerjaController;
use App\Http\Controllers\Pegawai\JadwalKuliahController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('katalog');
});

Route::get('/admin', function () {
    return redirect()->route('login');
});

// Route::middleware("auth")->group(function () {
//     Route::view("/admin/akun", "manajer/akun")->name("account");
//     Route::view("/admin", "manajer/dashboard")->name("dashboard");
//     Route::view("/admin/catalog", "manajer/katalog")->name("catalog");
//     Route::view("admin/jadwalkuliah", "manajer/jadwalkuliah")->name("jadwalkuliah");
//     Route::view("admin/jadwalpegawai", "manajer/jadwalpegawai")->name("jadwalpegawai");
//     Route::view("admin/rekapkehadiran", "manajer/rekapkehadiran")->name("adminkehadiran");

//     Route::view("pegawai/penjadwalan", "pegawai/penjadwalan")->name("penjadwalan");
//     Route::view("pegawai/profile", "pegawai/profile")->name("profile");
//     Route::view("pegawai/jadwal", "pegawai/jadwal")->name("jadwalpegawais");
//     Route::view("pegawai/rekapkehadiran", "pegawai/rekapkehadiran")->name("kehadiran");
// });           

// Route untuk admin
Route::middleware(['auth', 'cekjabatan:admin'])->prefix('admin')->group(function () {
    Route::view("/", "manajer/dashboard")->name("dashboard");
    Route::view("/akun", "manajer/akun")->name("account");
    Route::view("/catalog", "manajer/katalog")->name("catalog");
    Route::view("/jadwalkuliah", "manajer/jadwalkuliah")->name("jadwalkuliah");
    Route::view("/jadwalpegawai", "manajer/jadwalpegawai")->name("jadwalpegawai");
    Route::view("/rekapkehadiran", "manajer/rekapkehadiran")->name("adminkehadiran");
    
    Route::get('/jadwalkuliah', [JadwalKuliahController::class, 'index'])->name('jadwalkuliah.index');
    Route::post('/jadwalkuliah', [JadwalKerjaController::class, 'buatJadwal'])->name('jadwalKerja.buat');

    Route::get('/jadwalpegawai', [PresensiController::class, 'index'])->name('jadwalpegawai.index');
    Route::post('/jadwalpegawai', [PresensiController::class, 'savePresence'])->name('jadwalpegawai.savePresence');
    Route::get('/jadwalpegawai/{id}/edit', [PresensiController::class, 'editJamMasuk'])->name('jadwalpegawai.edit');
    Route::put('/jadwalpegawai/{id}', [PresensiController::class, 'updateJamMasuk'])->name('jadwalpegawai.update');
    Route::get('/rekapkehadiran', [PresensiController::class, 'adminRekapKehadiran'])->name('adminrekapkehadiran');

    Route::get('/katalog', [ProdukController::class, 'index'])->name('catalog');
    Route::post('/katalog', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/katalog/edit/{id}', [ProdukController::class, 'edit']);

    Route::put('/katalog/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/katalog/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::delete('/variasi/{id}', [VariasiController::class, 'destroy'])->name('variasi.destroy');

    Route::put('/variasi/{id}', [VariasiController::class, 'update'])->name('variasi.update');
    Route::post('/variasi', [VariasiController::class, 'store'])->name('variasi.store');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::post('/produk-kategori', [ProdukController::class, 'addCategory'])->name('produk.add-category');
});

// Route untuk pegawai
Route::middleware(['auth', 'cekjabatan:pegawai'])->prefix('pegawai')->group(function () {
    Route::view("/penjadwalan", "pegawai/penjadwalan")->name("penjadwalan");
    Route::view("/profile", "pegawai/profile")->name("profile");
    Route::view("/jadwal", "pegawai/jadwal")->name("jadwalpegawais");
    Route::view("/rekapkehadiran", "pegawai/rekapkehadiran")->name("kehadiran");
    // ... route pegawai lain ...
});

Route::post('pegawai/penjadwalan', [JadwalKuliahController::class, 'store'])->name('penjadwalan.store');
Route::get('pegawai/rekapkehadiran', [PresensiController::class, 'rekapKehadiran'])->name('rekapkehadiran');
Route::get('pegawai/jadwal', [JadwalKerjaController::class, 'index'])->name('jadwalkerja.index');

Route::get("/login", [AuthController::class, "login"])
    ->name("login");
Route::post("/login", [AuthController::class, "loginPost"])
    ->name("login.post");

Route::get("/register", [AuthController::class, "register"])
    ->name("register");
Route::post("/register", [AuthController::class, "registerPost"])
    ->name("register.post");

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view("produk", "customer/produk")->name("produk");

Route::get('/katalog', [ProdukController::class, 'indexKatalog'])->name('katalog');


Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
