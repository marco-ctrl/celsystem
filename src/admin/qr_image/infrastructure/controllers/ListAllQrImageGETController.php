<?php

namespace Src\admin\qr_image\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\QrImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListAllQrImageGETController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $term = $request->term;

            $qrImages = QrImage::when($term, function ($query, $term) {
                $query->where('description', 'LIKE', '%' . $term . '%');
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);

            return response()->json([
                'status' => true,
                'qrImages' => $qrImages,
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