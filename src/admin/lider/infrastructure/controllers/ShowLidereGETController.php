<?php

namespace Src\admin\lider\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Lider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowLidereGETController extends Controller
{
    public function index(Lider $lider): JsonResponse
    {
        try {
            $lider = Lider::with('celula', 'user')
            ->find($lider->id);

            return response()->json([
                'status' => true,
                'lider' => $lider,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('failed to list Lideres'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}