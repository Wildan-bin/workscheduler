<?php

use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return redirect()->route('katalog');
});

Route::get('/admin', function () {
    return redirect()->route('login');
});

Route::middleware("auth")->group(function () {
    
    Route::view("/admin", "manajer/dashboard")->name("dashboard");
});

Route::get('/admin/katalog', [ProdukController::class, 'index'])->name('catalog');
Route::post('/admin/katalog', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/admin/katalog/edit/{id}', [ProdukController::class, 'edit']);

Route::put('/admin/katalog/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/admin/katalog/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');


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

Route::get('/katalog', function () {
    // Cek apakah ada filter pencarian
    $produks = request('search') 
        ? Produk::filter(request(['search']))->latest()->paginate(9)->withQueryString()
        : Produk::latest()->paginate(9); // Tampilkan semua produk jika tidak ada pencarian

    return view('customer/katalog', [
        'title' => 'Daftar Produk',
        'produks' => $produks,
    ]);
});


Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
