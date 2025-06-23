<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [AdminController::class, 'index'])->name('login');

Route::prefix('menu')->group(function () {

    Route::get('/order', [AdminController::class , 'order'])->name('order');
    Route::get('/add', function () {
        return view('add');
    });
    Route::get('/edit', function () {
        return view('edit');
    });
    Route::get('/seeAll', function () {
        return view('allorder');
    });
});
