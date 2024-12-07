<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Rute untuk halaman utama (landing page)
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Rute untuk halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk dashboard setelah login
Route::get('/dashboard', function () {
    // Redirect ke dashboard admin atau daftar postingan sesuai role
    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
    }
    return redirect()->route('posts.index'); // Redirect ke daftar postingan untuk pengguna biasa
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup rute untuk admin yang dilindungi dengan middleware 'auth' dan 'is_admin'
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Rute untuk dashboard admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Rute untuk mengelola postingan (admin)
    Route::resource('posts', PostController::class); // Rute CRUD untuk postingan admin

    // Rute untuk mengelola kategori (admin)
    Route::resource('categories', CategoryController::class); // Rute CRUD untuk kategori admin
});

// Rute untuk menampilkan daftar postingan (untuk pengguna biasa)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Rute untuk menampilkan detail postingan
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Grup rute untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {
    // Rute untuk mengedit profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Rute otentikasi bawaan Laravel
require __DIR__.'/auth.php';