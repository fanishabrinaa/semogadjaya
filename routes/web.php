<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/order', [ProductController::class, 'indexOrder']);
Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::post('/contact/send', function () {
    return back()->with('success', 'Pesan berhasil dikirim!');
})->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/products', [AdminController::class, 'products']);
Route::get('/admin/testimonials', [AdminController::class, 'testimonials']);
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/create', [AdminController::class, 'create']);
Route::post('/admin/store', [AdminController::class, 'store']);
Route::post('/admin/update/{id}', [AdminController::class, 'update']);
Route::post('/admin/delete/{id}', [AdminController::class, 'destroy']);

Route::post('/admin/order/store', [AdminController::class, 'storeOrder']);
Route::post('/admin/order/status/{id}', [AdminController::class, 'updateOrderStatus']);
Route::post('/admin/order/delete/{id}', [AdminController::class, 'destroyOrder']);
Route::post('/admin/order/store-from-website', [AdminController::class, 'storeFromWebsite']);

Route::post('/admin/testimonial/store', [AdminController::class, 'storeTestimonial']);
Route::post('/admin/testimonial/update/{id}', [AdminController::class, 'updateTestimonial']);
Route::post('/admin/testimonial/delete/{id}', [AdminController::class, 'destroyTestimonial']);

require __DIR__.'/auth.php';
