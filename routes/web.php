<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('blog.index');
})->name('home');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/checkLogin', [UserController::class, 'checkLogin'])->name('checkLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/checkRegister', [UserController::class, 'checkRegister'])->name('checkRegister');
Route::post('/checkDuplicateEmail', [UserController::class, 'checkDuplicateEmail'])->name('checkDuplicateEmail');
