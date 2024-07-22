<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarBrandModelController;
use App\Http\Controllers\CarOptionalController;
use App\Http\Controllers\CarTransmissionController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MotorcycleBrandModelController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\MotorcycleOptionalController;
use App\Http\Controllers\MotorcycleTypesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/site/loja', function () {
    return view('lojas');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [UserController::class, 'list'])->name('users');
        Route::get('create', [UserController::class, 'createView'])->name('users.createView');
        Route::post('create', [UserController::class, 'create'])->name('users.create');
        Route::delete('{id}', [UserController::class, 'delete'])->name('users.delete')->where('id', '[0-9]+');
        Route::get('{id}', [UserController::class, 'getUser'])->name('users.get')->where('id', '[0-9]+');
        Route::patch('{id}', [UserController::class, 'edit'])->name('users.edit')->where('id', '[0-9]+');

        Route::get('list', [UserController::class, 'get'])->name('users.list');
    });

    Route::group(['prefix' => 'stores'], function () {
        Route::get('', [StoreController::class, 'index'])->name('stores');
        Route::inertia('create', 'Stores/Create');
        Route::get('{id}', [StoreController::class, 'getStore'])->name('stores.get')->where('id', '[0-9]+');
        Route::post('create', [StoreController::class, 'create'])->name('stores.create');
        Route::delete('{id}', [StoreController::class, 'delete'])->name('stores.delete')->where('id', '[0-9]+');
        Route::post('{id}', [StoreController::class, 'edit'])->name('stores.edit')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'colors'], function () {
        Route::get('', [ColorController::class, 'list'])->name('colors');
        Route::post('create', [ColorController::class, 'create'])->name('colors.create');
        Route::put('{id}', [ColorController::class, 'update'])->name('colors.update')->where('id', '[0-9]+');
        Route::delete('{id}', [ColorController::class, 'delete'])->name('colors.delete')->where('id', '[0-9]+');

        Route::get('list', [ColorController::class, 'get'])->name('colors.list');
    });

    Route::group(['prefix' => 'fuelTypes'], function () {
        Route::get('', [FuelTypeController::class, 'list'])->name('fuelTypes');
        Route::post('create', [FuelTypeController::class, 'create'])->name('fuelTypes.create');
        Route::put('{id}', [FuelTypeController::class, 'update'])->name('fuelTypes.update')->where('id', '[0-9]+');
        Route::delete('{id}', [FuelTypeController::class, 'delete'])->name('fuelTypes.delete')->where('id', '[0-9]+');

        Route::get('list', [FuelTypeController::class, 'get'])->name('fuelTypes.list');
    });

    Route::group(['prefix' => 'brands'], function () {
        Route::get('', [BrandController::class, 'list'])->name('brands');
        Route::post('create', [BrandController::class, 'create'])->name('brands.create');
        Route::put('{id}', [BrandController::class, 'update'])->name('brands.update')->where('id', '[0-9]+');
        Route::delete('{id}', [BrandController::class, 'delete'])->name('brands.delete')->where('id', '[0-9]+');

        Route::get('list', [BrandController::class, 'get'])->name('brands.list');
    });

    Route::group(['prefix' => 'brandModels'], function () {
        Route::get('', [CarBrandModelController::class, 'list'])->name('brandModels');
        Route::post('create', [CarBrandModelController::class, 'create'])->name('brandModels.create');
        Route::put('{id}', [CarBrandModelController::class, 'update'])->name('brandModels.update')->where('id', '[0-9]+');
        Route::delete('{id}', [CarBrandModelController::class, 'delete'])->name('brandModels.delete')->where('id', '[0-9]+');

        Route::get('list', [CarBrandModelController::class, 'get'])->name('brandModels.list');
    });

    Route::group(['prefix' => 'transmissions'], function () {
        Route::get('', [CarTransmissionController::class, 'list'])->name('transmissions');
        Route::post('create', [CarTransmissionController::class, 'create'])->name('transmissions.create');
        Route::put('{id}', [CarTransmissionController::class, 'update'])->name('transmissions.update')->where('id', '[0-9]+');
        Route::delete('{id}', [CarTransmissionController::class, 'delete'])->name('transmissions.delete')->where('id', '[0-9]+');

        Route::get('list', [CarTransmissionController::class, 'get'])->name('transmissions.list');
    });

    Route::group(['prefix' => 'optional'], function () {
        Route::get('', [CarOptionalController::class, 'list'])->name('optional');
        Route::post('create', [CarOptionalController::class, 'create'])->name('optional.create');
        Route::put('{id}', [CarOptionalController::class, 'update'])->name('optional.update')->where('id', '[0-9]+');
        Route::delete('{id}', [CarOptionalController::class, 'delete'])->name('optional.delete')->where('id', '[0-9]+');

        Route::get('list', [CarOptionalController::class, 'get'])->name('optional.list');
    });

    Route::group(['prefix' => 'vehicles'], function () {
        Route::get('', [VehicleController::class, 'list'])->name('vehicles');
        Route::inertia('create', 'Vehicles/Create')->name('vehicles.createView');
    });

    Route::group(['prefix' => 'motorcycle-brand-model'], function () {
        Route::get('', [MotorcycleBrandModelController::class, 'list'])->name('motorcycleBrandModel');
        Route::post('create', [MotorcycleBrandModelController::class, 'create'])->name('motorcycleBrandModel.create');
        Route::put('{id}', [MotorcycleBrandModelController::class, 'update'])->name('motorcycleBrandModel.update')->where('id', '[0-9]+');
        Route::delete('{id}', [MotorcycleBrandModelController::class, 'delete'])->name('motorcycleBrandModel.delete')->where('id', '[0-9]+');

        Route::get('list', [MotorcycleBrandModelController::class, 'get'])->name('motorcycleBrandModel.list');
    });

    Route::group(['prefix' => 'motorcycle-optional'], function () {
        Route::get('', [MotorcycleOptionalController::class, 'list'])->name('motorcycleOptional');
        Route::post('create', [MotorcycleOptionalController::class, 'create'])->name('motorcycleOptional.create');
        Route::put('{id}', [MotorcycleOptionalController::class, 'update'])->name('motorcycleOptional.update')->where('id', '[0-9]+');
        Route::delete('{id}', [MotorcycleOptionalController::class, 'delete'])->name('motorcycleOptional.delete')->where('id', '[0-9]+');

        Route::get('list', [MotorcycleOptionalController::class, 'get'])->name('motorcycleOptional.list');
    });

    Route::group(['prefix' => 'motorcycle-types'], function () {
        Route::get('', [MotorcycleTypesController::class, 'list'])->name('motorcycleTypes');
        Route::post('create', [MotorcycleTypesController::class, 'create'])->name('motorcycleTypes.create');
        Route::put('{id}', [MotorcycleTypesController::class, 'update'])->name('motorcycleTypes.update')->where('id', '[0-9]+');
        Route::delete('{id}', [MotorcycleTypesController::class, 'delete'])->name('motorcycleTypes.delete')->where('id', '[0-9]+');

        Route::get('list', [MotorcycleTypesController::class, 'get'])->name('motorcycleTypes.list');
    });

    Route::group(['prefix' => 'motorcycle'], function () {
        Route::get('', [MotorcycleController::class, 'list'])->name('motorcycle');
        Route::inertia('create', 'Motorcycle/Create')->name('motorcycle.createView');
        Route::post('create', [MotorcycleController::class, 'create'])->name('motorcycle.create');
    });
});

Route::get('/files/{fileName}', [ImageController::class, 'getImage'])->where('fileName', '.*');

require __DIR__ . '/auth.php';
