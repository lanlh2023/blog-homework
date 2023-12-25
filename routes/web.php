<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\HomeController;
use App\Models\Role;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/checkLogin', [UserController::class, 'checkLogin'])->name('checkLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/checkRegister', [UserController::class, 'checkRegister'])->name('checkRegister');
Route::post('/checkDuplicateEmail', [UserController::class, 'checkDuplicateEmail'])->name('checkDuplicateEmail');
Route::get('/{categoryName}', [HomeController::class, 'loadByCategory'])->name('loadByCategory');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'checkRole']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

    Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::post('/destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::get('/show/{id}', [PostController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('update');
        Route::match(['get', 'post'], '/exportCsv', [PostController::class, 'exportCsv'])->name('exportCsv');
    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
        Route::post('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->middleware(['isUserLogin'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->middleware(['isUserLogin'])->name('update');
    });

    Route::group(['prefix' => 'role_user', 'as' => 'role_user.'], function () {
        Route::get('/', [RoleUserController::class, 'index'])->name('index');
        Route::get('/create', [RoleUserController::class, 'create'])->name('create');
        Route::post('/store', [RoleUserController::class, 'store'])->name('store');
    });
});

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('/show/{id}', [HomeController::class, 'show'])->name('show');
});
