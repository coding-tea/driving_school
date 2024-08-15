<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
        Route::prefix('login')->name('login::')
            ->controller(AuthenticatedSessionController::class)
            ->group(function () {
            Route::get('', 'index')
                ->name('view');

            Route::post('', 'performAuthentication')
                ->name('check');
        });

        Route::prefix('forgot-password')
            ->name('forgot-password::')
            ->controller(PasswordResetLinkController::class)
            ->group(function () {
                Route::get('', 'index')
                    ->name('view');

                Route::post('', 'sendPasswordResetLink')
                    ->name('send-email');

            });

        Route::prefix('reset-password')
            ->name('reset-password::')
            ->controller(NewPasswordController::class)
            ->group(function () {
                Route::get('{token}','index')
                    ->name('view');
                Route::post('','performResetPassword')
                    ->name('reset');
            });
    });
Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthenticatedSessionController::class, 'performLogout'])
        ->name('logout');
});

