<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
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
    Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
        // logout
        Route::get('/logout', [AuthController::class, 'logout']);
        // connected as admin
        Route::group(['prefix' => 'admin'], function () {
            // landing page for admins
            Route::get('/', [AdminController::class, 'index']);
            // list of users
            Route::get('/users', [AdminController::class, 'users']);
            Route::post('/users/store', [AdminController::class, 'storeUser']);
            Route::put('/users/edit', [AdminController::class, 'editUser']);
            Route::delete('/users/delete/{id}', [AdminController::class, 'deleteUser']);
        });
    });

    // not connected
    Route::middleware(['guest'])->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });
});
