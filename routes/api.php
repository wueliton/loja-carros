<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Api\ApiCarController;
use App\Http\Controllers\Api\ApiMotorcycleController;
use App\Http\Controllers\Api\ApiQuickSearchParams;
use App\Http\Controllers\Api\ApiStoresController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarBrandModelController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarOptionalController;
use App\Http\Controllers\CarTransmissionController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\MotorcycleBrandModelController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\MotorcycleOptionalController;
use App\Http\Controllers\MotorcycleTypesController;
use App\Http\Controllers\Super\SuperStoreController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => '/api', 'as' => 'api.'], function () {
    /* AUTHENTICATED ROUTES */
    Route::group(['middleware' => ['auth']], function () {
        Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
            Route::post('', [BrandController::class, 'apiCreate'])->name('create');
            Route::get('', [BrandController::class, 'apiGet'])->name('list');
        });

        Route::group(['prefix' => 'colors', 'as' => 'colors.'], function () {
            Route::post('', [ColorController::class, 'apiCreate'])->name('create');
            Route::get('', [ColorController::class, 'apiGet'])->name('list');
        });

        Route::group(['prefix' => 'fuelType', 'as' => 'fuelType.'], function () {
            Route::post('', [FuelTypeController::class, 'apiCreate'])->name('create');
            Route::get('', [FuelTypeController::class, 'apiGet'])->name('list');
        });

        Route::group(['prefix' => '/cars', 'as' => 'cars.'], function () {
            Route::group(['prefix' => 'model', 'as' => 'model.'], function () {
                Route::post('', [CarBrandModelController::class, 'apiCreate'])->name('create');
                Route::get('', [CarBrandModelController::class, 'apiGet'])->name('list');
            });

            Route::group(['prefix' => 'transmission', 'as' => 'transmission.'], function () {
                Route::post('', [CarTransmissionController::class, 'apiCreate'])->name('create');
                Route::get('', [CarTransmissionController::class, 'apiGet'])->name('list');
            });

            Route::group(['prefix' => 'optionals', 'as' => 'optionals.'], function () {
                Route::post('', [CarOptionalController::class, 'apiCreate'])->name('create');
                Route::get('', [CarOptionalController::class, 'apiGet'])->name('list');
            });

            Route::group(['prefix' => 'images', 'as' => 'images.'], function () {
                Route::delete('{id}', [CarController::class, 'apiDeleteImage'])->name('delete')->where('id', '[0-9]+');
            });
        });

        Route::group(['prefix' => 'motorcycle', 'as' => 'motorcycle.'], function () {
            Route::group(['prefix' => 'model', 'as' => 'model.'], function () {
                Route::post('', [MotorcycleBrandModelController::class, 'apiCreate'])->name('create');
                Route::get('', [MotorcycleBrandModelController::class, 'apiGet'])->name('list');
            });

            Route::group(['prefix' => 'types', 'as' => 'types.'], function () {
                Route::post('', [MotorcycleTypesController::class, 'apiCreate'])->name('create');
                Route::get('', [MotorcycleTypesController::class, 'apiGet'])->name('list');
            });

            Route::group(['prefix' => 'optionals', 'as' => 'optionals.'], function () {
                Route::post('', [MotorcycleOptionalController::class, 'apiCreate'])->name('create');
                Route::get('', [MotorcycleOptionalController::class, 'apiGet'])->name('list');
            });

            Route::group(['prefix' => 'images', 'as' => 'images.'], function () {
                Route::delete('{id}', [MotorcycleController::class, 'apiDeleteImage'])->name('delete')->where('id', '[0-9]+');
            });
        });

        /* AUTHENTICATED ADMIN */
        Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin|super']], function () {
            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::get('', [AdminUserController::class, 'apiGet'])->name('list');
            });
        });

        Route::group(['prefix' => 'super', 'as' => 'super.', 'middleware' => ['role:super']], function () {
            Route::group(['prefix' => 'stores', 'as' => 'stores.'], function () {
                Route::get('', [SuperStoreController::class, 'apiGet'])->name('list');
            });
        });
    });

    /* PUBLIC ROUTES */
    Route::group(['prefix' => '/cars'], function () {
        Route::get('/highlights', [ApiCarController::class, 'highlights']);
        Route::get('/latest', [ApiCarController::class, 'latest']);
        Route::get('/brand-models', [ApiCarController::class, 'getBrandModels']);
        Route::get('{slug}', [ApiCarController::class, 'getBySlug']);
        Route::get('', [ApiCarController::class, 'find']);
    });

    Route::group(['prefix' => '/motorcycles'], function () {
        Route::get('/brand-models', [ApiMotorcycleController::class, 'getBrandModels']);
        Route::get('', [ApiMotorcycleController::class, 'find']);
        Route::get('{slug}', [ApiMotorcycleController::class, 'getBySlug']);
    });

    Route::group(['prefix' => '/search'], function () {
        Route::get('/quick/options', [ApiQuickSearchParams::class, 'quickSearchOptions']);
        Route::get('/advanced/options', [ApiQuickSearchParams::class, 'advancedSearchOptions']);
    });

    Route::group(['prefix' => 'stores', 'as' => 'stores.'], function () {
        Route::get('{slug}', [ApiStoresController::class, 'getBySlug']);
        Route::get('/ads/{id}', [ApiStoresController::class, 'getAds']);
        Route::get('', [ApiStoresController::class, 'find']);
    });
});
