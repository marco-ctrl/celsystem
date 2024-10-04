<?php

namespace Src\admin\lider\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Lider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListAllLideresGETController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $term = $request->term;
            $lideres = Lider::with('celula', 'user')
            ->where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('lastname', 'LIKE', '%' . $term . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

            return response()->json([
                'status' => true,
                'lideres' => $lideres,
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