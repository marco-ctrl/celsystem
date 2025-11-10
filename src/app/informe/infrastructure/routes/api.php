<?php

use Illuminate\Support\Facades\Route;
use Src\app\informe\infrastructure\controllers\ListAllInformeGETController;
use Src\app\informe\infrastructure\controllers\StoreInformePOSTController;
use Src\app\informe\infrastructure\controllers\ShowReportGETController;
use Src\app\informe\infrastructure\controllers\UpdateReportPUTController;

Route::prefix('app_informe')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllInformeGETController::class, 'index']);
        Route::post('/', [StoreInformePOSTController::class, 'index']);
        Route::get('/{report}', [ShowReportGETController::class, 'index']);
        Route::post('/update/{report}', [UpdateReportPUTController::class, 'index']);
    });
});