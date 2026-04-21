<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\MedicalItemController;
use App\Http\Controllers\MedicalProductController;
use App\Http\Controllers\StorageUnitController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    // Houses
    Route::get('/houses/{houseId}', [HouseController::class, 'show']);
    Route::put('/houses/modify-places', [HouseController::class, 'modifyPlaces']);

    // Medical Items
    Route::get('/medical-items', [MedicalItemController::class, 'list']);
    Route::get('/medical-items/{itemId}', [MedicalItemController::class, 'show']);
    Route::post('/medical-items', [MedicalItemController::class, 'store']);
    Route::delete('/medical-items/{itemId}', [MedicalItemController::class, 'destroy']);
    Route::post('/medical-items/consume', [MedicalItemController::class, 'consume']);

    // Medical Products
    Route::get('/medical-products', [MedicalProductController::class, 'list']);
    Route::get('/medical-products/{productId}', [MedicalProductController::class, 'show']);
    Route::post('/medical-products', [MedicalProductController::class, 'store']);

    // Storage Units
    Route::get('/storage-units', [StorageUnitController::class, 'list']);
    Route::get('/storage-units/{storageId}', [StorageUnitController::class, 'show']);
});

