<?php

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Developer\AllDevelopersController;
use App\Http\Controllers\Api\Developer\DeveloperDetailsController;
use App\Http\Controllers\Api\Developer\RandomDevsController;
use App\Http\Controllers\Api\Developer\StackController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Prestation\AllPrestationsController;
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
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logout']);

        // Profile Routes
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [ProfileController::class, 'index']);
            Route::put('/update', [ProfileController::class, 'update']);
            Route::put('/update-password', [ProfileController::class, 'updatePassword']);
            Route::delete('/delete', [ProfileController::class, 'delete']);

            // Stacks management on profile
            Route::group(['prefix' => 'stacks'], function () {
                Route::post('/store', [ProfileController::class, 'addStack']);
                Route::put('/edit-experience/{stack_id}', [ProfileController::class, 'editStackExperience']);
                Route::put('/edit-primary/{stack_id}', [ProfileController::class, 'editPrimaryStack']);
                Route::delete('/delete/{stack_id}', [ProfileController::class, 'deleteStack']);
            });

            // Prestations management on profile
            Route::group(['prefix' => 'prestations'], function () {
                Route::post('/store', [ProfileController::class, 'storePrestation']);
                Route::patch('/edit/{id}', [ProfileController::class, 'editPrestation']);
                Route::delete('/delete/{id}', [ProfileController::class, 'deletePrestation']);
            });
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', [OrderController::class, 'index']);
            Route::post('/store', [OrderController::class, 'store']);
            Route::get('/dev-prestations/{developer_id}', [OrderController::class, 'index']);
        });
    });
    // TODO: check these routes
    Route::get('/order/prestation-accepted/{order_id}', [OrderController::class, 'prestationAccepted']);
    Route::get('/order/prestation-rejected/{order_id}', [OrderController::class, 'prestationRejected']);
    Route::get('/order/prestation-finished/{order_id}', [OrderController::class, 'prestationFinished']);

    // NOT CONNECTED
    Route::middleware(['guest'])->group(function () {
        // Delete a user by his email. see test formClient.cy.js
        Route::delete('delete-user-by-email', [UserController::class, 'deleteUserByEmail']);

        // Authentication Routes + password reset
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('/reset-password', [AuthController::class, 'resetPassword']);

        // Developer details
        Route::get('/developer/{id}', [DeveloperDetailsController::class, 'developerDetails']);

        // Resend email verification
        Route::post('/new-email-verification', [VerifyEmailController::class, 'resendEmailVerification'])->name('verification.send');

        // homepage with random developers
        Route::get('/random-developers', [RandomDevsController::class, 'getSixRandomDevelopers']);

        // list of all developers
        Route::get('/all-developers', [AllDevelopersController::class, 'getAllDevelopers']);

        // get developer details as a user
        Route::get('/developer/{id}', [DeveloperDetailsController::class, 'developerDetails']);

        // Get all prestations available so a developer can add them to his profile
        Route::get('/all-prestations', [AllPrestationsController::class, 'index']);

        // Get all stacks available so a developer can add them to his profile
        Route::get('/all-stacks', [StackController::class, 'index']);

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
