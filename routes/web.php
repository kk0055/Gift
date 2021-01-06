<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ChatsController;



// Route::get('/', function () {
//     return view('main');
// });
Auth::routes();

Route::get('/', [ItemController::class, 'index'])->name('main');

Route::post('/', [ItemController::class, 'store'])->name('item.store');

Route::delete('/item/{item}', [ItemController::class, 'destroy'])->name('item.destroy');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');



Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/logout', [LoginController::class, 'logOut']);

//Chats
Route::get('chats', [ChatsController::class, 'index'])->name('chats');
Route::get('messages',[ChatsController::class, 'fetchMessages']);
Route::post('messages',[ChatsController::class, 'sendMessage']);