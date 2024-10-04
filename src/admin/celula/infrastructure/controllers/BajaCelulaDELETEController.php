<?php

namespace Src\admin\celula\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use App\Models\Lider;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class BajaCelulaDELETEController extends Controller
{
    public function index(Celula $celula): JsonResponse
    {
        try {
            if ($celula->status == 0) {
                $celula->status = 1;
                $celula->save();

                $message = 'Celula dado de alta correctamente';
            } else {
                $celula->status = 0;
                $celula->save();

                $message = 'Celula dado de baja correctamente';
            }


            return response()->json([
                'status' => true,
                'message' => $message,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'error al dar de baja esta celula',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}