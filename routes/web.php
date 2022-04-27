<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return redirect('/user/create');
});

Route::resource('/user', UserController::class);
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('post-login', [UserController::class, 'postLogin'])->name('login.post');
Route::get('account/verify/{token}', [UserController::class, 'verifyAccount'])->name('user.verify'); 
Route::get('user/blogs', [UserController::class, 'userBlogs'])->name('user.blogs'); 
