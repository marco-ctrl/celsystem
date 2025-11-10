<?php

use Illuminate\Support\Facades\Route;
use Src\admin\home\infrastructure\controllers\DataCardGETController;
use Src\admin\home\infrastructure\controllers\GetMonthlyAssistantAmountSumController;
use Src\admin\home\infrastructure\controllers\MembersTipeGETController;

Route::prefix('admin_home')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/card', [DataCardGETController::class, 'index']);
        Route::get('/assistant-amount', [GetMonthlyAssistantAmountSumController::class, 'index']);
        Route::get('/total-members-tipe', [MembersTipeGETController::class, 'index']);
    });
});
