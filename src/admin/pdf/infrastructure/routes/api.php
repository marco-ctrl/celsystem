<?php


use Illuminate\Support\Facades\Route;
use Src\admin\pdf\infrastructure\controllers\AllInformeGETController;
use Src\admin\pdf\infrastructure\controllers\InformeGETController;
use Src\admin\pdf\infrastructure\controllers\ReportCelulaGETController;

Route::prefix('admin_pdf')->group(function () {
    Route::get('/reporte-celula', [ReportCelulaGETController::class, 'index']);

    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/informe/{id}', [InformeGETController::class, 'index']);
        Route::get('/reporte-informe', [AllInformeGETController::class, 'index']);
        //Route::get('/reporte-celula', [ReportCelulaGETController::class, 'index']);
        //     // add as many authenticated routes as necessary
    });
});
