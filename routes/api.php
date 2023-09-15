<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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
Route::resource('users', UserController::class)->except(['create', 'edit']);

Route::resource('posts', PostController::class)->except(['create', 'edit']);

Route::resource('tags', TagController::class)->except(['create', 'edit']);

Route::get('/users/{userId}', [UserController::class, 'getUserById']);
Route::put('/users/{userId}', [UserController::class, 'updateUser']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
