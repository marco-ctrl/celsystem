<?php

use Illuminate\Support\Facades\Route;
use Src\admin\home\infrastructure\controllers\DataCardGETController;

Route::prefix('admin_home')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/card', [DataCardGETController::class, 'index']);
    });
});
