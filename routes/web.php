<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\kwtController;
use App\Http\Controllers\artikelController;
use App\Http\Controllers\maggotController;
use App\Http\Controllers\produkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', [dashboardController::class, 'index'])->name('welcome');
Route::get('/kwt', [kwtController::class, 'index'])->name('kwt');
Route::get('/maggot', [maggotController::class, 'index'])->name('maggot');
Route::get('/artikel/{id}', [maggotController::class, 'show'])->name('artikel.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/adminbeluk/inputproduk', function () {
    if (!Auth::check()) {  // Memeriksa apakah user sudah login
        return redirect('/');  // Arahkan ke halaman login jika belum login
    }
    
    // Panggil controller jika user sudah login
    return app(adminController::class)->inputproduk();
})->name('adminbeluk.inputproduk');

Route::get('/adminbeluk/inputkwt', function () {
    if (!Auth::check()) {
        return redirect('/');  // Arahkan ke halaman login jika belum login
    }
    
    return app(adminController::class)->inputkwt();
})->name('adminbeluk.inputkwt');

Route::post('/adminbeluk/inputkwt', [adminController::class, 'store'])->name('adminbeluk.inputkwt.store');
Route::get('/inputkwt/search', [adminController::class, 'search'])->name('adminbeluk.inputkwt.search');

Route::post('/adminbeluk/inputartikel', [adminController::class, 'article'])->name('adminbeluk.inputartikel.article');
Route::put('/adminbeluk/inputartikel/{id}', [artikelController::class, 'update'])->name('adminbeluk.inputartikel.update');

Route::post('/adminbeluk/inputproduk', [adminController::class, 'produk'])->name('adminbeluk.inputproduk.produk');
Route::put('/adminbeluk/inputproduk/{id}', [produkController::class, 'update'])->name('adminbeluk.inputproduk.update');

Route::prefix('adminbeluk')->group(function() {
    Route::get('/inputkwt/{id}/edit', [adminController::class, 'edit'])->name('adminbeluk.inputkwt.edit');
    Route::put('/inputkwt/{id}', [adminController::class, 'update'])->name('adminbeluk.inputkwt.update');
    Route::delete('/inputkwt/{id}', [adminController::class, 'destroy'])->name('adminbeluk.inputkwt.destroy');
});

Route::prefix('adminbeluk')->group(function() {
    Route::get('/inputartikel/{id}/edit', [artikelController::class, 'edit'])->name('adminbeluk.inputartikel.edit');
    Route::put('/inputartikel/{id}', [artikelController::class, 'update'])->name('adminbeluk.inputartikel.update');
    Route::delete('/inputartikel/{id}', [artikelController::class, 'destroy'])->name('adminbeluk.inputartikel.destroy');
});

Route::prefix('adminbeluk')->group(function() {
    Route::get('/inputproduk/{id}/edit', [produkController::class, 'edit'])->name('adminbeluk.inputproduk.edit');
    Route::put('/inputproduk/{id}', [produkController::class, 'update'])->name('adminbeluk.inputproduk.update');
    Route::delete('/inputproduk/{id}', [produkController::class, 'destroy'])->name('adminbeluk.inputproduk.destroy');
});

Route::get('/adminbeluk/inputartikel', function () {
    if (!Auth::check()) {
        return redirect('/adminbeluk/inputartikel');  // Arahkan ke halaman login jika belum login
    }
    
    return app(adminController::class)->inputartikel();
})->name('adminbeluk.inputartikel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
