<?php

namespace Src\admin\qr_image\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\QrImage;
use Illuminate\Http\JsonResponse;

final class DowloadQrImageGETController extends Controller
{
    public function index(QrImage $qrImage)
    {
        try {
            $relativePath = str_replace('/storage/', '', $qrImage->image);
            $path = storage_path('app/public/' . $relativePath);

            if (!file_exists($path)) {
                return response()->json(['error' => 'Archivo no encontrado'], 404);
            }

            // Descargar con un nombre más legible
            $fileName = 'qr-image-' . $qrImage->id . '.' . pathinfo($path, PATHINFO_EXTENSION);

            return response()->download($path, $fileName, [
                'Content-Type' => mime_content_type($path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al descargar la imagen Qr',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
