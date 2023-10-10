<?php

use App\Http\Controllers\Company\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'list'])
        ->name('company.category.list');

    Route::post('/', [CategoryController::class, 'store'])
        ->name('company.category.store');

    Route::put('/{categoryId}', [CategoryController::class, 'show'])
        ->where('categoryId', '[0-9]+')
        ->name('company.category.show');

    Route::put('/{categoryId}', [CategoryController::class, 'update'])
        ->where('categoryId', '[0-9]+')
        ->name('company.category.update');

    Route::delete('/{categoryId}', [CategoryController::class, 'destroy'])
        ->where('categoryId', '[0-9]+')
        ->name('company.category.destroy');

    Route::post('/check-slug', [CategoryController::class, 'checkSlug'])
        ->name('company.category.checkSlug');
});
