<?php

use Illuminate\Support\Facades\Route;
use Src\app\member\infrastructure\controllers\SearchAsistenteGETController;
use Src\app\member\infrastructure\controllers\BajaMemberDELETEController;
use Src\app\member\infrastructure\controllers\ListAllMemberGETController;
use Src\app\member\infrastructure\controllers\SearchVisitaGETController;
use Src\app\member\infrastructure\controllers\ShowMemberGETController;
use Src\app\member\infrastructure\controllers\StoreMemberPOSTController;
use Src\app\member\infrastructure\controllers\UpdateMemberPUTController;

Route::prefix('app_member')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllMemberGETController::class, 'index']);
        Route::post('/', [StoreMemberPOSTController::class, 'index']);
        Route::put('/{member}', [UpdateMemberPUTController::class, 'index']);
        Route::get('/{member}', [ShowMemberGETController::class, 'index']);
        Route::delete('/{member}', [BajaMemberDELETEController::class, 'index']);
        Route::get('/{celula}/asistencia', [SearchAsistenteGETController::class, 'index']);
        Route::get('/{celula}/visita', [SearchVisitaGETController::class, 'index']);
    });
});