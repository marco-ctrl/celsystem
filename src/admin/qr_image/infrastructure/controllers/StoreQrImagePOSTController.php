<?php

namespace Src\admin\qr_image\infrastructure\controllers;

use App\Models\QrImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Src\admin\qr_image\infrastructure\validators\StoreQrImageRequest;
use Symfony\Component\HttpFoundation\Response;

final class StoreQrImagePOSTController
{
    public function index(StoreQrImageRequest $request): JsonResponse
    {
        try {
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                // Carpeta dentro de /public
                $folder = 'images/qr_images';

                // Crear carpeta si no existe
                if (!file_exists(public_path($folder))) {
                    mkdir(public_path($folder), 0775, true);
                }

                // Nombre único manteniendo la extensión
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                // Guardar el archivo físicamente en /public/qr_images
                $file->move(public_path($folder), $fileName);

                // Ruta relativa pública
                $path = $folder . '/' . $fileName;
            }

            //$path = $request->file('image')->store('qr_images', 'public');

            $qrImage = QrImage::create([
                'description' => $request->description,
                'valid_from' => $request->valid_from,
                'expired' => $request->expired,
                'image' => $path,
                'amount' => $request->amount,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Imagen Qr guardado con exito',
                'qrImage' => $qrImage
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => 'error al guardar imagen Qr',
                'request' => $request->file('image'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
