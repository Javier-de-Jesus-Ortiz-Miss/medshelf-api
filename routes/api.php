<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/products', [ProductController::class, 'add']);
Route::get('/products', [ProductController::class, 'list']);

