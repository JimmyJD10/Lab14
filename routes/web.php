<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'getAllProduct']); 
Route::get('/products/{id}', [ProductController::class, 'getProductById']);
Route::get('/products/{id}/name', [ProductController::class, 'getProductNameById']);
Route::get('/product-names', [ProductController::class, 'getProductNames']);
Route::post('/products', [ProductController::class, 'insertSingleProduct']);
Route::post('/products/multiple', [ProductController::class, 'insertMultipleProducts']);
Route::put('/products/{id}', [ProductController::class, 'updateSingleProduct']); 
Route::put('/products', [ProductController::class, 'updateMultipleProducts']);
Route::delete('/products/{id}', [ProductController::class, 'deleteSingleProduct']);
Route::delete('/products', [ProductController::class, 'deleteMultipleProducts']);
Route::get('/products/join', [ProductController::class, 'joinQueries']);
Route::get('/products/groupby', [ProductController::class, 'groupByHaving']);
