<?php

namespace Src\admin\celula\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowCelulaGETController extends Controller
{
    public function index(Celula $celula): JsonResponse
    {
        try {
            
            $data = $celula->with('lider')->find($celula->id);

            return response()->json([
                'status' => true,
                'celula' => $data, 
            ], Response::HTTP_OK);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => __('failed to list Celulas'),
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}