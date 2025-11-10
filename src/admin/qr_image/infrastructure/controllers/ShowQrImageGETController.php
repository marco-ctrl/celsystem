<?php

namespace Src\admin\qr_image\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\QrImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowQrImageGETController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $qrImage = QrImage::where('status', true)
            ->first();
            
            return response()->json([
                'status' => true,
                'qrImage' => $qrImage,
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to list QrImage'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}