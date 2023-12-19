<?php

use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::post('/store', [UsersController::class, 'store'])->name('store');
    Route::get('/show/{id}', [UsersController::class, 'show'])->name('show');
    Route::post('/destroy/{id}', [UsersController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [UsersController::class, 'update'])->name('update');
});
