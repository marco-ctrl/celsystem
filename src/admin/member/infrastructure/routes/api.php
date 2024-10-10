<?php

use Illuminate\Support\Facades\Route;
use Src\admin\member\infrastructure\controllers\BajaMemberDELETEController;
use Src\admin\member\infrastructure\controllers\ListAllMemberGETController;
use Src\admin\member\infrastructure\controllers\SearchAsistenteGETController;
use Src\admin\member\infrastructure\controllers\SearchVisitaGETController;
use Src\admin\member\infrastructure\controllers\ShowMemberGETController;
use Src\admin\member\infrastructure\controllers\StoreMemberPOSTController;
use Src\admin\member\infrastructure\controllers\UpdateMemberPUTController;

Route::prefix('admin_member')->group(function () {
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