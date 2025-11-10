<?php

namespace Src\app\celula\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use Illuminate\Http\JsonResponse;
use Src\app\celula\infrastructure\validators\UpdateCelulaRequest;
use Symfony\Component\HttpFoundation\Response;

final class UpdateCelulaPUTController extends Controller
{
    public function index(Celula $celula, UpdateCelulaRequest $request): JsonResponse
    {
        try {
            $data = [
                'name' => strtoupper($request->name),
                'addres' => strtoupper($request->addres),
                'day' => $request->day,
                'hour' => $request->hour,
                'latitude' => $request->latitude,
                'length' => $request->length,
                'tipe' => $request->tipe,
            ];

            $celula->update($data);
            
            return response()->json([
                'status' => true,
                'message' => 'Celula Modificado con Exito',
                'celula' => $celula,
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => 'Error al modificar una celula'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}