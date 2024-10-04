<?php

namespace Src\admin\celula\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use Illuminate\Http\JsonResponse;
use Src\admin\celula\infrastructure\validators\StoreCelulaRequest;
use Src\admin\lider\infrastructure\validators\StoreLiderRequest;
use Symfony\Component\HttpFoundation\Response;

final class StoreCelulaPOSTController extends Controller
{
    public function index(StoreCelulaRequest $request): JsonResponse
    {
        try {
            $data = [
                'number' => $request->number,
                'name' => strtoupper($request->name),
                'addres' => strtoupper($request->addres),
                'day' => $request->day,
                'hour' => $request->hour,
                'latitude' => $request->latitude,
                'length' => $request->length,
                'lider_id' => $request->lider_id,
            ];

            $celula = new Celula($data);
            $celula->save();

            return response()->json([
                'status' => true,
                'message' => 'Celula Registrado con Exito',
                'celula' => $celula,
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => 'Error al registrar una celula'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}