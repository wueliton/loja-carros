<?php

use App\Http\Controllers\Admin\AdminStoreController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarBrandModelController;
use App\Http\Controllers\CarOptionalController;
use App\Http\Controllers\CarTransmissionController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\MotorcycleBrandModelController;
use App\Http\Controllers\MotorcycleOptionalController;
use App\Http\Controllers\MotorcycleTypesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin|super']], function () {
    Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
        Route::get('', [AdminStoreController::class, 'edit'])->name('edit.view');
        Route::post('', [AdminStoreController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('', [AdminUserController::class, 'list'])->name('list.view');
        Route::get('create', [AdminUserController::class, 'new'])->name('create.view');
        Route::get('{id}', [AdminUserController::class, 'edit'])->name('edit.view')->where('id', '[0-9]+');
        Route::patch('{id}', [AdminUserController::class, 'update'])->name('update')->where('id', '[0-9]+');
        Route::post('', [AdminUserController::class, 'create'])->name('create');
        Route::delete('{id}', [AdminUserController::class, 'create'])->name('delete')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'colors', 'as' => 'colors.'], function () {
        Route::get('', [ColorController::class, 'list'])->name('list.view');
        Route::post('create', [ColorController::class, 'create'])->name('create');
        Route::put('{id}', [ColorController::class, 'update'])->name('update')->where('id', '[0-9]+');
        Route::delete('{id}', [ColorController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
        Route::get('', [BrandController::class, 'list'])->name('list.view');
        Route::post('create', [BrandController::class, 'create'])->name('create');
        Route::put('{id}', [BrandController::class, 'update'])->name('update')->where('id', '[0-9]+');
        Route::delete('{id}', [BrandController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'fuel-types', 'as' => 'fuelTypes.'], function () {
        Route::get('', [FuelTypeController::class, 'list'])->name('list.view');
        Route::post('create', [FuelTypeController::class, 'create'])->name('create');
        Route::put('{id}', [FuelTypeController::class, 'update'])->name('update')->where('id', '[0-9]+');
        Route::delete('{id}', [FuelTypeController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'cars', 'as' => 'cars.'], function () {
        Route::group(['prefix' => 'models', 'as' => 'models.'], function () {
            Route::get('', [CarBrandModelController::class, 'list'])->name('list.view');
            Route::post('create', [CarBrandModelController::class, 'create'])->name('create');
            Route::put('{id}', [CarBrandModelController::class, 'update'])->name('update')->where('id', '[0-9]+');
            Route::delete('{id}', [CarBrandModelController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'transmissions', 'as' => 'transmissions.'], function () {
            Route::get('', [CarTransmissionController::class, 'list'])->name('list.view');
            Route::post('create', [CarTransmissionController::class, 'create'])->name('create');
            Route::put('{id}', [CarTransmissionController::class, 'update'])->name('update')->where('id', '[0-9]+');
            Route::delete('{id}', [CarTransmissionController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'optionals', 'as' => 'optionals.'], function () {
            Route::get('', [CarOptionalController::class, 'list'])->name('list.view');
            Route::post('create', [CarOptionalController::class, 'create'])->name('create');
            Route::put('{id}', [CarOptionalController::class, 'update'])->name('update')->where('id', '[0-9]+');
            Route::delete('{id}', [CarOptionalController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
        });
    });

    Route::group(['prefix' => 'motorcycles', 'as' => 'motorcycles.'], function () {
        Route::group(['prefix' => 'models', 'as' => 'models.'], function () {
            Route::get('', [MotorcycleBrandModelController::class, 'list'])->name('list.view');
            Route::post('create', [MotorcycleBrandModelController::class, 'create'])->name('create');
            Route::put('{id}', [MotorcycleBrandModelController::class, 'update'])->name('update')->where('id', '[0-9]+');
            Route::delete('{id}', [MotorcycleBrandModelController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'types', 'as' => 'types.'], function () {
            Route::get('', [MotorcycleTypesController::class, 'list'])->name('list.view');
            Route::post('create', [MotorcycleTypesController::class, 'create'])->name('create');
            Route::put('{id}', [MotorcycleTypesController::class, 'update'])->name('edit')->where('id', '[0-9]+');
            Route::delete('{id}', [MotorcycleTypesController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'optionals', 'as' => 'optionals.'], function () {
            Route::get('', [MotorcycleOptionalController::class, 'list'])->name('list.view');
            Route::post('create', [MotorcycleOptionalController::class, 'create'])->name('create');
            Route::put('{id}', [MotorcycleOptionalController::class, 'update'])->name('edit')->where('id', '[0-9]+');
            Route::delete('{id}', [MotorcycleOptionalController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
        });
    });
});
