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
Route::get('/item/{itemId}', [ItemController::class, 'show'])->name('item.show');

Route::post('/', [ItemController::class, 'store'])->name('item.store');

Route::delete('/item/{item}', [ItemController::class, 'destroy'])->name('item.destroy');



Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');



//Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/logout', [LoginController::class, 'logOut']);

//Chats
Route::get('chats/{items}', [ChatsController::class, 'sendChat'])->name('chats');
// Route::get('/chat/{recieve}' ,[ChatsController::class, 'sendChat'])->name('sendChat');

Route::post('chat/send' , [ChatsController::class, 'store'])->name('chatSend');

//Twitter Login
Route::get('/login/{provider}',
[LoginController::class, 'redirectToProvider'])->name('twitter.login');

Route::get('/login/{provider}/callback',
[LoginController::class, 'handleProviderCallback']);

