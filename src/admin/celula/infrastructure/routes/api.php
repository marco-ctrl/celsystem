<?php

use Illuminate\Support\Facades\Route;
use Src\admin\celula\infrastructure\controllers\BajaCelulaDELETEController;
use Src\admin\celula\infrastructure\controllers\ListAllCelulasGETController;
use Src\admin\celula\infrastructure\controllers\ListAllMapsCelulasGETController;
use Src\admin\celula\infrastructure\controllers\ShowCelulaGETController;
use Src\admin\celula\infrastructure\controllers\StoreCelulaPOSTController;
use Src\admin\celula\infrastructure\controllers\UpdateCelulaPUTController;

Route::prefix('admin_celula')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllCelulasGETController::class, 'index']);
        Route::post('/', [StoreCelulaPOSTController::class, 'index']);
        Route::get('/{celula}', [ShowCelulaGETController::class, 'index']);
        Route::put('/{celula}', [UpdateCelulaPUTController::class, 'index']);
        Route::delete('/{celula}', [BajaCelulaDELETEController::class, 'index']);
        Route::get('/map/celula', [ListAllMapsCelulasGETController::class, 'index']);
    });
});