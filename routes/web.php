<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Product\ReportController;
use App\Http\Controllers\StockEntryController;
use App\Http\Controllers\StockExitController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;

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

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Master Data
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::resource('stock-in', StockEntryController::class);
    Route::resource('stock-out', StockExitController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    //user profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
Route::get('/reports/export', [ReportController::class, 'exportExcel'])->name('reports.export');

require __DIR__ . '/auth.php';
