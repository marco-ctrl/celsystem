<?php

use Illuminate\Support\Facades\Route;
use Src\admin\report\infrastructure\controllers\BajaReportDELETEController;
use Src\admin\report\infrastructure\controllers\ListAllReportGETController;
use Src\admin\report\infrastructure\controllers\ShowReportGETController;
use Src\admin\report\infrastructure\controllers\StoreReportPOSTController;
use Src\admin\report\infrastructure\controllers\UpdateReportPUTController;

Route::prefix('admin_report')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllReportGETController::class, 'index']);
        Route::post('/', [StoreReportPOSTController::class, 'index']);
        Route::get('/{report}', [ShowReportGETController::class, 'index']);
        Route::post('/update/{report}', [UpdateReportPUTController::class, 'index']);
        Route::delete('/{report}', [BajaReportDELETEController::class, 'index']);
    });
});
