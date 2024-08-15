<?php

declare(strict_types=1);

use App\Http\Controllers\UserManagement\AssignProfileController;
use App\Http\Controllers\UserManagement\CollaboratorProfileController;
use App\Http\Controllers\UserManagement\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('', fn () => redirect(\route('profiles')));


Route::middleware('auth')->group(function () {

    Route::get('/', [ProfileController::class, 'index'])->name('profiles');
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');

    Route::prefix('profile')->name('profile.')
        ->controller(CollaboratorProfileController::class)->group(
            function () {
                Route::get('', 'index')->name('index');
                Route::get('establishment', 'Establishment')->name('establishment');
                Route::post('save', 'save')->name('save');
                Route::post('update-account', 'updateAccount')->name('account.update');
            }
        );

    Route::name('profiles.')->prefix('profiles')
        ->controller(ProfileController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('{profile}/show', 'show')->name('show');
            Route::post('{profile}/update', 'update')->name('update');
            Route::get('assignment', [AssignProfileController::class, 'index'])->name('assignment');
        });
});


require_once 'auth.php';
require_once 'ess.php';
require_once 'charge.php';
