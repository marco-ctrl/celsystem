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

            if(!$user){
                return response()->json([
                    'status' => false,
                    'message' => 'Error al crear usuario',
                ], Response::HTTP_OK);
            }

           // Manejo de la imagen
           $foto = $lider->foto;
           if(IsBase64::isBase64Image($request->foto)){
           //if ($request->foto) {
               // Eliminar la imagen anterior si existe
               if ($lider->foto){
                   Storage::disk('public')->delete($lider->foto);
               }

               // Decodifica la imagen base64 y guarda el archivo
               $imageData = $request->foto;
               list($type, $imageData) = explode(';', $imageData);
               list(, $imageData)      = explode(',', $imageData);
               $imageData = base64_decode($imageData);
               $imagePath = 'images/' . uniqid() . '.png'; // Puedes ajustar el nombre y formato del archivo
               Storage::disk('public')->put($imagePath, $imageData);
               $foto = $imagePath;
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

            if(!$lider){
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