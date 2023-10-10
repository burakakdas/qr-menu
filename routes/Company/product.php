<?php

use App\Http\Controllers\Company\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'list'])
        ->name('company.product.list');

    Route::post('/', [ProductController::class, 'store'])
        ->name('company.product.store');

    Route::put('/{productId}', [ProductController::class, 'update'])
        ->where('productId', '[0-9]+')
        ->name('company.product.update');

    Route::post('/check-slug', [ProductController::class, 'checkSlug'])
        ->name('company.product.checkSlug');

    Route::delete('/{productId}', [ProductController::class, 'destroy'])
        ->where('productId', '[0-9]+')
        ->name('company.product.destroy');
});
