<?php

use App\Http\Controllers\Company\BranchProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('branches/{branchId}/products')->group(function () {
    Route::get('/', [BranchProductController::class,'list'])
        ->where('branchId', '[0-9]+')
        ->name('company.branchProduct.list');

    Route::post('/', [BranchProductController::class, 'store'])
        ->where('branchId', '[0-9]+')
        ->name('company.branchProduct.store');

    Route::get('/{branchProductId}', [BranchProductController::class, 'show'])
        ->name('company.branchProduct.show');

    Route::put('/{branchProductId}', [BranchProductController::class, 'update'])
        ->where('branchId', '[0-9]+')
        ->where('branchProductId', '[0-9]+')
        ->name('company.branchProduct.update');

    Route::delete('/{branchProductId}', [BranchProductController::class, 'destroy'])
        ->where('branchId', '[0-9]+')
        ->where('branchProductId', '[0-9]+')
        ->name('company.branchProduct.destroy');
});
