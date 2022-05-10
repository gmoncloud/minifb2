<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\UserAuthsController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\CommentController;

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

Route::prefix('v1')->group(function () {
    Route::post('/register', [UserAuthsController::class, 'register']);
    Route::post('/login', [UserAuthsController::class, 'login']);
});

Route::middleware('auth:api')->prefix('v1')->group(function() {
    Route::apiResource('post', PostController::class);
    Route::apiResource('comment', CommentController::class);
});