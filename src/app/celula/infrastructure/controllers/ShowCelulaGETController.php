<?php

namespace Src\app\celula\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use Symfony\Component\HttpFoundation\Response;

final class ShowCelulaGETController extends Controller
{

    public function index()
    {
        try {

            $data = Celula::with('lider')
            ->where('lider_id', auth()->user()->id)
            ->first();

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
