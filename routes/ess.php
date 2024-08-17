<?php

use App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    Route::name('profile.')
        ->prefix('profile')
        ->controller(Controllers\ProfileController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::post('delete', 'destroyGroup')->name('destroyGroup');
            Route::get('{profile}/delete', 'destroy')->name('destroy');
            Route::get('{profile}/show', 'show')->name('show');
            Route::post('{profile}/update/', 'update')->name('update');
        }
    );

    Route::name('contract.')
        ->prefix('contract')
        ->controller(Controllers\ProfileController::class)
        ->group(function () {
            Route::get('/formation/{id}', 'donwloaPdf')->name('pdf');
        }
    );

    Route::name('offices.')
        ->prefix('offices')
        ->controller(Controllers\OfficeController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::post('delete', 'destroyGroup')->name('destroyGroup');
            Route::get('{office}/delete', 'destroy')->name('destroy');
            Route::get('{office}/show', 'show')->name('show');
            Route::post('{office}/update/', 'update')->name('update');
        }
    );

    Route::name('staffs.')
        ->prefix('staffs')
        ->controller(Controllers\StaffController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::post('delete', 'destroyGroup')->name('destroyGroup');
            Route::get('{staff}/delete', 'destroy')->name('destroy');
            Route::post('{staff}/update/', 'update')->name('update');
        }
    );

    Route::name('payments.')
        ->prefix('payments')
        ->controller(Controllers\PaymentController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::post('delete', 'destroyGroup')->name('destroyGroup');
            Route::get('{payment}/delete', 'destroy')->name('destroy');
            Route::post('{payment}/update/', 'update')->name('update');
        }
    );

    Route::name('cars.')
        ->prefix('cars')
        ->controller(Controllers\CarController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::post('delete', 'destroyGroup')->name('destroyGroup');
            Route::get('{car}/delete', 'destroy')->name('destroy');
            Route::post('{car}/update/', 'update')->name('update');
        }
    );


});