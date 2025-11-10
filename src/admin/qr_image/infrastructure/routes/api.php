<?php

use Illuminate\Support\Facades\Route;
use Src\admin\qr_image\infrastructure\controllers\DowloadQrImageGETController;
use Src\admin\qr_image\infrastructure\controllers\ListAllQrImageGETController;
use Src\admin\qr_image\infrastructure\controllers\ShowQrImageGETController;
use Src\admin\qr_image\infrastructure\controllers\StoreQrImagePOSTController;
use Src\admin\qr_image\infrastructure\controllers\UpdateQrImagePUTController;

Route::prefix('admin_qr_image')->group(function () {
    Route::get('/{qrImage}/download', [DowloadQrImageGETController::class, 'index']);
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllQrImageGETController::class, 'index']);
        Route::post('/', [StoreQrImagePOSTController::class, 'index']);
        Route::put('/{qrImage}', [UpdateQrImagePUTController::class, 'index']);
        Route::get('/show/active', [ShowQrImageGETController::class, 'index']);
    });
});