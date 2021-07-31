<?= <<<'STUB'
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/**
 * Authentication Route
 */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);

/**
 * Email verification
 */
Route::group(['middleware' => ['auth:api'], 'prefix' => 'email'], function () {
    Route::get('verify/{id}/{hash}', [AuthController::class, 'emailVerified'])
        ->middleware(['signed'])
        ->name('verification.verify');

    Route::get('verify', [AuthController::class, 'emailVerificationRequired'])->name('verification.notice');

    Route::post('verification-notification', [AuthController::class, 'sendVerificationEmail'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});
STUB;