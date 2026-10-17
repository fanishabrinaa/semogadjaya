<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Halaman publik
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'index']);
Route::get('/order', [ProductController::class, 'indexOrder']);
Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::post('/contact/send', function () {
    return back()->with('success', 'Pesan berhasil dikirim!');
})->middleware('throttle:5,1')->name('contact.send');

/*
|--------------------------------------------------------------------------
| Endpoint publik: pelanggan mengirim pesanan dari website
|--------------------------------------------------------------------------
| Sengaja DI LUAR group auth karena dipanggil pelanggan (tanpa login).
| Dibatasi 10 request per menit per IP supaya tidak bisa dibanjiri order palsu.
| URL dipertahankan agar JavaScript di halaman order/beranda tidak perlu diubah.
*/
Route::post('/admin/order/store-from-website', [AdminController::class, 'storeFromWebsite'])
    ->middleware('throttle:10,1');

/*
|--------------------------------------------------------------------------
| Profil (login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Panel admin (WAJIB login)
|--------------------------------------------------------------------------
| URL tetap sama seperti sebelumnya, hanya sekarang dilindungi middleware auth.
*/
Route::middleware('auth')->prefix('admin')->group(function () {

    // Dashboard & produk
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/products', [AdminController::class, 'products']);
    Route::get('/create', [AdminController::class, 'create']);
    Route::post('/store', [AdminController::class, 'store']);
    Route::post('/update/{id}', [AdminController::class, 'update']);
    Route::post('/delete/{id}', [AdminController::class, 'destroy']);

    // Order
    Route::post('/order/store', [AdminController::class, 'storeOrder']);
    Route::post('/order/status/{id}', [AdminController::class, 'updateOrderStatus']);
    Route::post('/order/delete/{id}', [AdminController::class, 'destroyOrder']);

    // Testimoni
    Route::get('/testimonials', [AdminController::class, 'testimonials']);
    Route::post('/testimonial/store', [AdminController::class, 'storeTestimonial']);
    Route::post('/testimonial/update/{id}', [AdminController::class, 'updateTestimonial']);
    Route::post('/testimonial/delete/{id}', [AdminController::class, 'destroyTestimonial']);
});

require __DIR__.'/auth.php';