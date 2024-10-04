<?php

use Illuminate\Support\Facades\Route;
use Src\admin\qr_image\infrastructure\controllers\ListAllQrImageGETController;

Route::prefix('admin_qr_image')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllQrImageGETController::class, 'index']);
    });
});
