<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\BrandModelController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
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

// Usuários
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'list'])->name('users');
    Route::get('/users/create', [UserController::class, 'createView']);
    Route::post('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete')->where('id', '[0-9]+');
    Route::get('/users/{id}', [UserController::class, 'getUser'])->name('users.get')->where('id', '[0-9]+');
    Route::patch('users/{id}', [UserController::class, 'edit'])->name('users.edit')->where('id', '[0-9]+');

    Route::get('/users/list', [UserController::class, 'get'])->name('users.list');
});

// Lojas
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/stores', [StoreController::class, 'index'])->name('stores');
    Route::inertia('/stores/create', 'Stores/Create');
    Route::get('/stores/{id}', [StoreController::class, 'getStore'])->name('stores.get')->where('id', '[0-9]+');
    Route::post('/stores/create', [StoreController::class, 'create'])->name('stores.create');
    Route::delete('/stores/{id}', [StoreController::class, 'delete'])->name('stores.delete')->where('id', '[0-9]+');
    Route::post('/stores/{id}', [StoreController::class, 'edit'])->name('stores.edit')->where('id', '[0-9]+');
});

// Colors
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/colors', [ColorController::class, 'list'])->name('colors');
    Route::post('/colors/create', [ColorController::class, 'create'])->name('colors.create');
    Route::put('/colors/{id}', [ColorController::class, 'update'])->name('colors.update')->where('id', '[0-9]+');
    Route::delete('/colors/{id}', [ColorController::class, 'delete'])->name('colors.delete')->where('id', '[0-9]+');
});

// FuelTypes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/fuelTypes', [FuelTypeController::class, 'list'])->name('fuelTypes');
    Route::post('/fuelTypes/create', [FuelTypeController::class, 'create'])->name('fuelTypes.create');
    Route::put('/fuelTypes/{id}', [FuelTypeController::class, 'update'])->name('fuelTypes.update')->where('id', '[0-9]+');
    Route::delete('/fuelTypes/{id}', [FuelTypeController::class, 'delete'])->name('fuelTypes.delete')->where('id', '[0-9]+');
});

// Brand
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/brands', [BrandController::class, 'list'])->name('brands');
    Route::post('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::put('/brands/{id}', [BrandController::class, 'update'])->name('brands.update')->where('id', '[0-9]+');
    Route::delete('/brands/{id}', [BrandController::class, 'delete'])->name('brands.delete')->where('id', '[0-9]+');

    Route::get('/brands/list', [BrandController::class, 'get'])->name('brands.list');
});

// Brand
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/brandModels', [BrandModelController::class, 'list'])->name('brandModels');
    Route::post('/brandModels/create', [BrandModelController::class, 'create'])->name('brandModels.create');
    Route::put('/brandModels/{id}', [BrandModelController::class, 'update'])->name('brandModels.update')->where('id', '[0-9]+');
    Route::delete('/brandModels/{id}', [BrandModelController::class, 'delete'])->name('brandModels.delete')->where('id', '[0-9]+');
});

Route::get('/files/{fileName}', [ImageController::class, 'getImage'])->where('fileName', '.*');

require __DIR__ . '/auth.php';
