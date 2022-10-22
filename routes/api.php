<?php

use App\Http\Controllers\Api\Admin\HomeController;
use App\Http\Controllers\Api\Admin\PrestationController;
use App\Http\Controllers\Api\Admin\StackController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Developer\AllDevsController;
use App\Http\Controllers\Api\Developer\RandomDevsController;
use App\Http\Controllers\Api\Profile\ProfileController;
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
// Middleware for all routes to only return JSON
Route::middleware('jsonOnly')->group(function () {
    // CONNECTED AND EMAIL VERIFIED
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logout']);

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
            // Stacks management
            Route::group(['prefix' => 'stacks'], function () {
                Route::get('/', [StackController::class, 'stacks']);
                Route::post('/store', [StackController::class, 'storeStack']);
                Route::put('/edit', [StackController::class, 'editStack']);
                Route::delete('/delete/{id}', [StackController::class, 'deleteStack']);
            });
            // Prestations CRUD
            Route::group(['prefix' => 'prestations'], function () {
                Route::get('/', [PrestationController::class, 'prestations']);
                Route::post('/store', [PrestationController::class, 'storePrestation']);
                Route::put('/edit', [PrestationController::class, 'editPrestation']);
                Route::delete('/delete/{id}', [PrestationController::class, 'deletePrestation']);
            });
        });
    });

    // NOT CONNECTED
    Route::middleware(['guest'])->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        // Resend email verification
        Route::post('/new-email-verification', [VerifyEmailController::class, 'resendEmailVerification'])->name('verification.send');
        Route::get('/random-users', [RandomDevsController::class, 'getSixRandomUsers']);
        Route::get('/all-developers', [AllDevsController::class, 'getAllDevs']);
        Route::get('/user-profile/{id}', [ProfileController::class, 'index']);
    });
});
