<?php

use App\Http\Controllers\Api\Admin\HomeController;
use App\Http\Controllers\Api\Admin\StackController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\RandomDevsController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('jsonOnly')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        // connected as admin
        Route::group(['prefix' => 'admin', 'middleware' => 'can:isAdmin'], function () {
            // landing page for admins
            Route::get('/', [HomeController::class, 'index']);
            // list of users
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [UserController::class, 'users']);
                Route::post('/store', [UserController::class, 'storeUser']);
                Route::put('/edit', [UserController::class, 'editUser']);
                Route::delete('/delete/{id}', [UserController::class, 'deleteUser']);
            });

            Route::group(['prefix' => 'stacks'], function () {
                Route::get('/', [StackController::class, 'stacks']);
                Route::post('/store', [StackController::class, 'storeStack']);
                Route::put('/edit', [StackController::class, 'editStack']);
                Route::delete('/delete/{id}', [StackController::class, 'deleteStack']);
            });
        });
        // logout
        Route::get('/logout', [AuthController::class, 'logout']);
    });

    // not connected
    Route::middleware(['guest'])->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/random-users', [RandomDevsController::class, 'recoversSixRandomUsers']);
    });
});
