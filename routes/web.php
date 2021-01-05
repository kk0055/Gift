<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ItemController;



// Route::get('/', function () {
//     return view('main');
// });

Route::get('/', [ItemController::class, 'index']);

Route::post('/', [ItemController::class, 'store'])->name('item.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
