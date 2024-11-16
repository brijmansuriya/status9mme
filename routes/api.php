<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

//login

//posts
Route::prefix('auth')->group(function () {
    Route::post('/login',[LoginController::class,'login']);
});

//posts
Route::prefix('posts')->group(function () {
    Route::get('/',[PostController::class,'index']);
});

