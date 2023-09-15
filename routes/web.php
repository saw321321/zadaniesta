<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AuthController;
//use app\Http\Controllers\UserController;
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
Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/users', 'AdminController@users');
    Route::get('/admin/posts', 'AdminController@posts');

});


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

Route::get('/logout', 'Auth\AuthController@logout')->name('logout')->middleware('auth');


Route::get('/search_user', 'UserController@searchUser')->name('search_user');



Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');

Route::get('/users/{userId}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');

Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');



Route::get('/posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');

Route::get('/posts/{id}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');

Route::get('/posts/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::post('/tags', [\App\Http\Controllers\TagController::class, 'store'])->name('tags.store');

Route::get('/tags', [\App\Http\Controllers\TagController::class, 'index'])->name('tags.index');


Route::get('home', function () {
    return view('/home');
})->middleware(['auth'])->name('dashboard');

Auth::routes();