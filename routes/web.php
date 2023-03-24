<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//category
Route::resource('/category', CategoryController::class)->middleware('auth');

Route::get('/searchCategory', [CategoryController::class,'getBySearch'])->middleware('auth');


//product
Route::resource('/product', ProductController::class)->middleware('auth');

Route::get('/search', [ProductController::class,'getBySearch'])->middleware('auth');

Route::get('/filterByCategory', [ProductController::class,'filterByCategory'])->middleware('auth');

Route::get('/sortProduct', [ProductController::class,'sortProduct'])->middleware('auth');

//admin
Route::resource('/', AdminController::class)->middleware('auth');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('auth');

require __DIR__.'/auth.php';
