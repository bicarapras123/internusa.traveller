<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TravelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;

// Halaman Utama (Publik)
Route::get('/', [TravelController::class, 'index'])->name('home');
Route::get('/travel/{travelItem:slug}', [TravelController::class, 'showItem'])->name('travel.show');
Route::get('/search', [TravelController::class, 'search'])->name('travel.search');

// Tambahkan kategori
Route::get('/travel/category/{category}', [TravelController::class, 'filterByCategory'])->name('travel.category');

// Tambahkan destiantions
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');

// Tambahkan contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// =======================
// CEK BOOKING (PUBLIK)
// =======================
Route::get('/check-booking', [OrderController::class, 'searchForm'])
    ->name('booking.search.form');

Route::post('/check-booking', [OrderController::class, 'search'])
    ->name('booking.search');

        // Menggunakan route parameter {id} untuk menangkap ID destinasi
Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.index');

        // Tambahkan baris ini untuk menangani form POST
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');


// GANTI MENJADI INI:
Route::get('/dashboard', [TravelController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- Route Manajemen (Hanya untuk Admin/User Terautentikasi) ---
// --- Route Manajemen (Hanya untuk Admin/User Terautentikasi) ---
Route::middleware('auth')->group(function () {
    
    // Travel Items
    Route::post('/travel-items', [TravelController::class, 'storeItem'])->name('travel-items.store');
    Route::get('/travel-items/{travelItem}/edit', [TravelController::class, 'edit'])->name('travel-items.edit');
    Route::match(['put', 'patch'], '/travel-items/{id}', [TravelController::class, 'update'])
    ->name('travel-items.update');
    Route::delete('/travel-items/{travelItem}', [TravelController::class, 'destroy'])->name('travel-items.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // TAMBAHKAN INI AGAR ERROR HILANG:
    Route::get('/admin/bookings', [DashboardController::class, 'index'])->name('admin.bookings.index');
    
    Route::patch('/admin/bookings/{booking}/status', [App\Http\Controllers\Admin\DashboardController::class, 'updateStatus'])
    ->name('admin.bookings.update-status');
});

require __DIR__.'/auth.php';