<?php


use Illuminate\Support\Facades\Route;
use Src\admin\lider\infrastructure\controllers\BajaLiderDELETEController;
use Src\admin\lider\infrastructure\controllers\ListAllLideresGETController;
use Src\admin\lider\infrastructure\controllers\ShowLidereGETController;
use Src\admin\lider\infrastructure\controllers\StoreLiderPOSTController;
use Src\admin\lider\infrastructure\controllers\UpdateLiderPUTController;

Route::prefix('admin_lider')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllLideresGETController::class, 'index']);
        Route::get('/{lider}', [ShowLidereGETController::class, 'index']);
        Route::post('/', [StoreLiderPOSTController::class, 'index']);
        Route::put('/{lider}', [UpdateLiderPUTController::class, 'index']);
        Route::delete('/{lider}', [BajaLiderDELETEController::class, 'index']);
    });
});
