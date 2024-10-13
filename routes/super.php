<?php

use App\Http\Controllers\Super\SuperCarController;
use App\Http\Controllers\Super\SuperMotorcycleController;
use App\Http\Controllers\Super\SuperStoreController;
use App\Http\Controllers\Super\SuperUserController;
use Illuminate\Support\Facades\Route;

Route::group(['middlware' => ['auth', 'role:super'], 'prefix' => 'super', 'as' => 'super.'], function () {
    Route::group(['prefix' => 'stores', 'as' => 'stores.'], function () {
        Route::get('', [SuperStoreController::class, 'listView'])->name('list.view');
        Route::inertia('create', 'Super/Stores/Create')->name('create.view');
        Route::get('{id}', [SuperStoreController::class, 'editView'])->name('edit.view');
        Route::post('', [SuperStoreController::class, 'create'])->name('create');
        Route::post('{id}', [SuperStoreController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::delete('{id}', [SuperStoreController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('', [SuperUserController::class, 'listView'])->name('list.view');
        Route::get('create', [SuperUserController::class, 'createView'])->name('create.view');
        Route::get('{id}', [SuperUserController::class, 'editView'])->name('edit.view')->where('id', '[0-9]+');
        Route::post('', [SuperUserController::class, 'create'])->name('create');
        Route::post('{id}', [SuperUserController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::delete('{id}', [SuperUserController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'cars', 'as' => 'cars.'], function () {
        Route::get('', [SuperCarController::class, 'listView'])->name('list.view');
        Route::get('create', [SuperCarController::class, 'createView'])->name('create.view');
        Route::get('{id}', [SuperCarController::class, 'editView'])->name('edit.view')->where('id', '[0-9]+');
        Route::post('', [SuperCarController::class, 'create'])->name('create');
        Route::post('{id}', [SuperCarController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::delete('{id}', [SuperCarController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'motorcycles', 'as' => 'motorcycles.'], function () {
        Route::get('', [SuperMotorcycleController::class, 'listView'])->name('list.view');
        Route::get('create', [SuperMotorcycleController::class, 'createView'])->name('create.view');
        Route::get('{id}', [SuperMotorcycleController::class, 'editView'])->name('edit.view')->where('id', '[0-9]+');
        Route::post('', [SuperMotorcycleController::class, 'create'])->name('create');
        Route::post('{id}', [SuperMotorcycleController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::delete('{id}', [SuperMotorcycleController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });
});
