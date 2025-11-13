<?php

namespace Src\admin\qr_image\infrastructure\controllers;

use App\Models\QrImage;
use Illuminate\Http\JsonResponse;
use Src\admin\qr_image\infrastructure\validators\UpdateQrImageRequest;
use Symfony\Component\HttpFoundation\Response;

final class UpdateQrImagePUTController
{
    public function index(UpdateQrImageRequest $request, QrImage $qrImage): JsonResponse
    {
        try {
            // Si viene nueva imagen
            /* if ($request->hasFile('image')) {
                // Opcional: eliminar la anterior si quieres
                if ($qrImage->image && file_exists(public_path($qrImage->image))) {
                    unlink(public_path($qrImage->image));
                }

                $path = $request->file('image')->store('qr_images', 'public');
                $qrImage->image = $path;
            }*/

            // Si viene nueva imagen
            if ($request->hasFile('image')) {

                // Eliminar imagen anterior si existe
                if (!empty($qrImage->image) && file_exists(public_path($qrImage->image))) {
                    unlink(public_path($qrImage->image));
                }

                $file = $request->file('image');

                // Carpeta destino en /public
                $folder = 'qr_images';

                // Crear carpeta si no existe
                if (!file_exists(public_path($folder))) {
                    mkdir(public_path($folder), 0775, true);
                }

                // Nombre único manteniendo la extensión original
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                // Guardar archivo en la carpeta public/qr_images
                $file->move(public_path($folder), $fileName);

                // Ruta relativa que guardarás en la base de datos
                $qrImage->image = $folder . '/' . $fileName;
            }


            $qrImage->update([
                'description' => $request->description,
                'valid_from' => $request->valid_from,
                'expired' => $request->expired,
                'amount' => $request->amount,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Imagen Qr Modificado con exito',
                'qrImage' => $qrImage
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => 'error al guardar imagen Qr',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
