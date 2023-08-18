<?php

use App\Http\Controllers\Company\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'list'])
        ->name('company.user.list');

    Route::post('/', [UserController::class, 'store'])
        ->name('company.user.store');

    Route::get('/{userId}', [UserController::class, 'show'])
        ->name('company.user.show')
        ->where('userId', '[0-9]+');

    Route::put('/{userId}', [UserController::class, 'update'])
        ->name('company.user.update')
        ->where('userId', '[0-9]+');

    Route::delete('/{userId}', [UserController::class, 'destroy'])
        ->name('company.user.destroy')
        ->where('userId', '[0-9]+');
});
