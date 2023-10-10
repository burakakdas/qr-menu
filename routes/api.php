<?php

use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(), 'middleware' => ['localizationRedirect']], function ()
{
    Route::prefix('v1')->group(function () {
        require __DIR__.'/auth.php';

        Route::get('languages', [\App\Http\Controllers\LocalizationController::class, 'index'])
            ->name('languages');

        Route::get('/menu/{companySlug}', [MenuController::class, 'categories'])
            ->name('menu.categories');

        Route::get('/menu/{companySlug}/{categorySlug}', [MenuController::class, 'categoryProducts'])
            ->name('menu.categoryProducts');

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/user', function (Request $request) {
                return $request->user();
            });

            Route::prefix('company')->group(function () {
                require __DIR__.'/Company/branch.php';
                require __DIR__.'/Company/branchProduct.php';
                require __DIR__.'/Company/category.php';
                require __DIR__.'/Company/company.php';
                require __DIR__.'/Company/product.php';
                require __DIR__.'/Company/user.php';
            });
        });
    });
});

