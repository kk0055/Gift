<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// //List items
// Route::get('/items', [ItemController::class, 'index']);

// //List Single item
// Route::get('/item/{id}', [ItemController::class, 'show']);

// //New item
// Route::post('/item', [ItemController::class, 'store']);

// //Update
// Route::put('/item', [ItemController::class, 'store']);

// //Delete item
// Route::delete('/item/{id}', [ItemController::class, 'destroy']);