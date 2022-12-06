<?php

use App\Http\Controllers\Api\Admin\PrestationController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Developer\AllDevelopersController;
use App\Http\Controllers\Api\Developer\DeveloperDetailsController;
use App\Http\Controllers\Api\Developer\RandomDevsController;
use App\Http\Controllers\Api\Developer\StackController;
use App\Http\Controllers\Api\DeveloperPrestation\DeveloperPrestationController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Stripe\PaymentController;
use App\Http\Controllers\Api\Stripe\StripeController;
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
        // connected as admin
        Route::group(['prefix' => 'admin', 'middleware' => 'can:isAdmin'], function () {
            // list of users
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [UserController::class, 'users']);
                Route::post('/store', [UserController::class, 'storeUser']);
                Route::put('/edit', [UserController::class, 'editUser']);
                Route::delete('/delete/{id}', [UserController::class, 'deleteUser']);
            });
            // Prestations CRUD
            Route::group(['prefix' => 'prestations'], function () {
                Route::get('/', [PrestationController::class, 'prestations']);
                Route::post('/store', [PrestationController::class, 'storePrestation']);
                Route::put('/edit', [PrestationController::class, 'editPrestation']);
                Route::delete('/delete/{id}', [PrestationController::class, 'deletePrestation']);
            });
        });

        Route::get('/logout', [AuthController::class, 'logout']);

        // connected as user
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [ProfileController::class, 'index']);
            Route::put('/update', [ProfileController::class, 'update']);
            Route::put('/update-password', [ProfileController::class, 'updatePassword']);
            Route::delete('/delete', [ProfileController::class, 'delete']);
            Route::post('/add-stack/{stack_id}', [StackController::class, 'addStack']);
            Route::delete('/delete-stack/{stack_id}', [StackController::class, 'deleteDevStack']);
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', [OrderController::class, 'index']);
            Route::post('/store', [OrderController::class, 'store']);
            Route::get('/dev-prestations/{developer_id}', [OrderController::class, 'index']);
        });

        // Stacks management for developer
        Route::group(['prefix' => 'stacks'], function () {
            Route::post('/store', [StackController::class, 'storeStack']);
            Route::put('/edit', [StackController::class, 'editStack']);
            Route::delete('/delete/{id}', [StackController::class, 'deleteStack']);
        });

        // Developer prestations management for developer
        Route::group(['prefix' => 'developer-prestations'], function () {
            Route::post('/store', [DeveloperPrestationController::class, 'storeDevPrestation']);
            Route::put('/edit', [DeveloperPrestationController::class, 'editDevPrestation']);
            Route::delete('/delete/{id}', [DeveloperPrestationController::class, 'deleteDevPrestation']);
        });
    });

    Route::get('/stacks/all', [StackController::class, 'allStack']);

    Route::get('/order/prestation-accepted/{order_id}', [OrderController::class, 'prestationAccepted']);
    Route::get('/order/prestation-rejected/{order_id}', [OrderController::class, 'prestationRejected']);
    Route::get('/order/prestation-finished/{order_id}', [OrderController::class, 'prestationFinished']);

    // NOT CONNECTED
    Route::middleware(['guest'])->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
//        Route::post('/reset-password', [AuthController::class, 'resetPassword']);
        // Developer details
        Route::get('/developer/{id}', [DeveloperDetailsController::class, 'developerDetails']);
        // Resend email verification
        Route::post('/new-email-verification', [VerifyEmailController::class, 'resendEmailVerification'])->name('verification.send');
        Route::get('/random-developers', [RandomDevsController::class, 'getSixRandomDevelopers']);
        Route::get('/all-developers', [AllDevelopersController::class, 'getAllDevelopers']);
        Route::get('/profile/{id}', [ProfileController::class, 'index']);
        Route::get('/developer/{id}', [DeveloperDetailsController::class, 'developerDetails']);

        // Create stripe session for payment
        Route::match(['get', 'post'], '/order/create-session/{id}', [
            StripeController::class, 'createSession',
        ])->name('order-session');
        // Get developer prestation for payment
        Route::get('/recap-developer-prestation/{id}', [PaymentController::class, 'recapDeveloperPrestation']);
        // Payment success
        Route::get('/payment-success/{stripeSessionId}/{developerPrestationId}', [PaymentController::class, 'success']);
        // Payment canceled
        Route::get('/payment-canceled/{stripeSessionId}/{developerPrestationId}', [PaymentController::class, 'canceled']);
    });
});
