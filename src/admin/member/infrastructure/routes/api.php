<?php

use Illuminate\Support\Facades\Route;
use Src\admin\member\infrastructure\controllers\ListAllMemberGETController;
use Src\admin\member\infrastructure\controllers\SearchAsistenteGETController;
use Src\admin\member\infrastructure\controllers\SearchVisitaGETController;

Route::prefix('admin_member')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllMemberGETController::class, 'index']);
        Route::get('/{celula}/asistencia', [SearchAsistenteGETController::class, 'index']);
        Route::get('/{celula}/visita', [SearchVisitaGETController::class, 'index']);
    });
});