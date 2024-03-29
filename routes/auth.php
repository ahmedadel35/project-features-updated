<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ChangeUserPasswordController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ExternalLogin\FacebookLoginController;
use App\Http\Controllers\ExternalLogin\GithubLoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name(
        'register'
    );

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [
        AuthenticatedSessionController::class,
        'create',
    ])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [
        PasswordResetLinkController::class,
        'create',
    ])->name('password.request');

    Route::post('forgot-password', [
        PasswordResetLinkController::class,
        'store',
    ])->name('password.email');

    Route::get('reset-password/{token}', [
        NewPasswordController::class,
        'create',
    ])->name('password.reset');

    Route::post('reset-password', [
        NewPasswordController::class,
        'store',
    ])->name('password.update');

    Route::prefix('/ext-login')
        ->name('ext-login.')
        ->middleware('guest')
        ->group(function () {
            Route::controller(FacebookLoginController::class)
                ->name('facebook.')
                ->prefix('/facebook')
                ->group(function () {
                    Route::get('', 'redirect')->name('redirect');
                    Route::get('/callback', 'callback')->name('callback');
                });

            Route::controller(GithubLoginController::class)
                ->name('github.')
                ->prefix('/github')
                ->group(function () {
                    Route::get('', 'redirect')->name('redirect');
                    Route::get('/callback', 'callback')->name('callback');
                });
        });
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [
        EmailVerificationPromptController::class,
        '__invoke',
    ])->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [
        VerifyEmailController::class,
        '__invoke',
    ])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [
        EmailVerificationNotificationController::class,
        'store',
    ])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [
        ConfirmablePasswordController::class,
        'show',
    ])->name('password.confirm');

    Route::post('confirm-password', [
        ConfirmablePasswordController::class,
        'store',
    ]);

    Route::post('logout', [
        AuthenticatedSessionController::class,
        'destroy',
    ])->name('logout');

    Route::controller(ChangeUserPasswordController::class)->name('change-password.')->prefix('change-password')->group(function () {
        Route::get('', 'create')->name('create');
        Route::put('', 'update')->name('update');
    });
});
