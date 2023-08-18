<?php

use App\Http\Controllers\Company\BranchController;
use Illuminate\Support\Facades\Route;

Route::prefix('branches')->group(function () {
    Route::get('/', [BranchController::class,'list'])
        ->name('company.branch.list');

    Route::post('/', [BranchController::class,'store'])
        ->name('company.branch.store');

    Route::put('/{branchId}', [BranchController::class,'update'])
        ->where('branchId', '[0-9]+')
        ->name('company.branch.update');

    Route::delete('/{branchId}', [BranchController::class,'destroy'])
        ->where('branchId', '[0-9]+');
});
