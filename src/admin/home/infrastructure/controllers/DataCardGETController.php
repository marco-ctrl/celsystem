<?php

namespace Src\admin\home\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use App\Models\Lider;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class DataCardGETController extends Controller
{

    public function index(): JsonResponse
    {
        try {
            $celulas = Celula::where('status', 1)->count();
            $lideres = Lider::where('status', 1)->count();
            $asistentes = Member::where('status', 1)
                ->where('tipe', '<>', 2)
                ->count();
            $visitas = Member::where('status', 1)
            ->where('tipe', 2)
            ->count();

            $data = [
                ['color' => 'blue', 'length' => $celulas, 'title' => 'Celulas:', 'icon' => 'home'],
                ['color' => 'green', 'length' => $lideres, 'title' => 'Lideres:', 'icon' => 'person'],
                ['color' => 'yellow', 'length' => $asistentes, 'title' => 'Asistentes', 'icon' => 'group'],
                ['color' => 'red', 'length' => $visitas, 'title' => 'Visitas', 'icon' => 'group'],
            ];

            return response()->json([
                'status' => true,
                'data' => $data,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error al listar datos de card',
                'error' => $e->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
