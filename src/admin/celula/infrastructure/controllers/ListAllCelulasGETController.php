<?php

namespace Src\admin\celula\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListAllCelulasGETController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $celulas = Celula::with('lider')
            ->where('number', 'LIKE', "%$request->term%")
            ->orWhere('name', 'LIKE', "%$request->term%")
            ->orderBy('id', 'desc')
            ->paginate(10);

            return response()->json([
                'status' => true,
                'celulas' => $celulas, 
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