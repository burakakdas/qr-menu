<?php

use App\Http\Controllers\Company\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CompanyController::class, 'show'])
    ->name('company.show');

Route::put('/', [CompanyController::class, 'update'])
    ->name('company.update');

Route::post('/check-slug', [CompanyController::class, 'checkSlug'])
    ->name('company.checkSlug');
