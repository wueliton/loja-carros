<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserStoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middlware' => ['auth']], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('', [DashboardController::class, 'dashboard'])->name('dashboard');
    });

    Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
        Route::get('', [UserStoreController::class, 'getView'])->name('edit.view');
        Route::post('', [UserStoreController::class, 'suggestChanges'])->name('suggest-change');
    });

    Route::group(['prefix' => 'motorcycle', 'as' => 'motorcycle.'], function () {
        Route::get('', [MotorcycleController::class, 'list'])->name('list.view');
        Route::inertia('create', 'User/Motorcycle/Create/index')->name('create.view');
        Route::get('{id}', [MotorcycleController::class, 'editView'])->name('edit.view');
        Route::post('', [MotorcycleController::class, 'create'])->name('create');
        Route::post('{id}', [MotorcycleController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::delete('{id}', [MotorcycleController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'cars', 'as' => 'cars.'], function () {
        Route::get('', [CarController::class, 'list'])->name('list.view');
        Route::inertia('create', 'User/Cars/Create/index')->name('create.view');
        Route::get('{id}', [CarController::class, 'editView'])->name('edit.view');
        Route::post('', [CarController::class, 'create'])->name('create');
        Route::post('{id}', [CarController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::delete('{id}', [CarController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('', [ProfileController::class, 'update'])->name('update');
        Route::delete('', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

Route::get('/files/{fileName}', [ImageController::class, 'getImage'])->where('fileName', '.*')->name('files');

require __DIR__ . '/auth.php';
