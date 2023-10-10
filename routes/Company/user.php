<?php

use App\Http\Controllers\Company\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'list'])
        ->name('company.user.list');

    Route::post('/', [UserController::class, 'store'])
        ->name('company.user.store');

    Route::get('/{userId}', [UserController::class, 'show'])
        ->where('userId', '[0-9]+')
        ->name('company.user.show');

    Route::put('/{userId}', [UserController::class, 'update'])
        ->where('userId', '[0-9]+')
        ->name('company.user.update');

    Route::delete('/{userId}', [UserController::class, 'destroy'])
        ->where('userId', '[0-9]+')
        ->name('company.user.destroy');
});
