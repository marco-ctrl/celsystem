<?php

namespace Src\admin\lider\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Lider;
use App\Models\User;
use App\helpers\IsBase64;
use GuzzleHttp\Promise\Is;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Src\admin\lider\infrastructure\validators\UpdateLiderRequest;

final class UpdateLiderPUTController extends Controller
{
    public function index(Lider $lider, UpdateLiderRequest $request): JsonResponse
    {
        //try {
        $user = User::find($lider->user_id);
        $user->updated([
            'name' => $request->name,
            'email' => $request->email,
            'tipe' => 1,
        ]);
        $user->save();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Error al crear usuario',
            ], Response::HTTP_OK);
        }

        // Manejo de la imagen
        $foto = $lider->foto;
        if (IsBase64::isBase64Image($request->foto)) {

            // Eliminar la imagen anterior si existe
            if ($lider->foto && file_exists(public_path($lider->foto))) {
                unlink(public_path($lider->foto));
            }

            // Decodifica la imagen base64
            $imageData = $request->foto;
            list($type, $imageData) = explode(';', $imageData);
            list(, $imageData) = explode(',', $imageData);
            $imageData = base64_decode($imageData);

            // Construye la ruta física en /public/images
            $fileName = uniqid() . '.png';
            $imagePath = public_path('images/perfil/' . $fileName);

            // Guarda la imagen directamente en public/images
            file_put_contents($imagePath, $imageData);

            // Guarda la ruta relativa en la BD
            $foto = 'images/perfil/' . $fileName;
        }


        $lider->update([
            'name' => strtoupper($request->name),
            'lastname' => strtoupper($request->lastname),
            'birthdate' => $request->birthdate,
            'addres' => strtoupper($request->addres),
            'contact' => strtoupper($request->contact),
            'foto' => $foto,
            'user_id' => $user->id,
            'code' => $request->code,
        ]);

        if (!$lider) {
            return response()->json([
                'status' => false,
                'message' => 'Error al modificar lider',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'message' => 'Lider modificado correctamente',
            'data' => $lider,
        ], Response::HTTP_OK);

        /*} catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to save Lider'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }*/
    }
}
