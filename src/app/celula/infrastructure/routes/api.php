<?php

use Illuminate\Support\Facades\Route;
use Src\app\celula\infrastructure\controllers\UpdateCelulaPUTController;
use Src\app\celula\infrastructure\controllers\ShowCelulaGETController;

Route::prefix('app_celula')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ShowCelulaGETController::class, 'index']);
        Route::put('/{celula}', [UpdateCelulaPUTController::class, 'index']);
    });
});
