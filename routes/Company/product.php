<?php

use App\Http\Controllers\Company\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'list'])
        ->name('company.product.list');

    Route::post('/', [ProductController::class, 'store'])
        ->name('company.product.store');

    Route::put('/{ProductId}', [ProductController::class, 'update'])
        ->where('ProductId', '[0-9]+')
        ->name('company.product.update');

    Route::post('/check-slug', [ProductController::class, 'checkSlug'])
        ->name('company.product.checkSlug');

    Route::delete('/{ProductId}', [ProductController::class, 'destroy'])
        ->where('ProductId', '[0-9]+')
        ->name('company.product.destroy');
});
