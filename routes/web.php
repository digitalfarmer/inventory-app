<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\StockEntryController;
use App\Http\Controllers\StockExitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', function () {
    return redirect()->route('home'); // Kita redirect ke home buatan kita
})->middleware(['auth', 'verified'])->name('dashboard');


// Grup Route yang wajib Login
Route::middleware(['auth'])->group(function () {
    
    // Halaman Utama/Dashboard kita
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Master Data
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    
});

Route::resource('stock-in', StockEntryController::class);
Route::resource('stock-out', StockExitController::class);

require __DIR__.'/auth.php';
