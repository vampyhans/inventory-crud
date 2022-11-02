<?php

use Illuminate\Support\Facades\Route;
use ProtoneMedia\LaravelXssProtection\Middleware\XssCleanInput;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => ['ho', 'auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('home', [App\Http\Controllers\HO\UserController::class, 'index'])->name('home');

    //products routes
    Route::get('products', [App\Http\Controllers\HO\ProductController::class, 'products'])->name('products');
    Route::get('add-product', [App\Http\Controllers\HO\ProductController::class, 'add'])->name('add-product');
    Route::post('save-product', [App\Http\Controllers\HO\ProductController::class, 'save'])->name('save-product');
    Route::get('edit-product/{id}', [App\Http\Controllers\HO\ProductController::class, 'edit'])->name('edit-product');
    Route::post('update-product/{id}', [App\Http\Controllers\HO\ProductController::class, 'update'])->name('update-product');
    Route::get('delete-product/{id}', [App\Http\Controllers\HO\ProductController::class, 'delete'])->name('delete-product');
});
