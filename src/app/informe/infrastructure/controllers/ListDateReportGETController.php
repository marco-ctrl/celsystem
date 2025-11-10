<?php

namespace Src\admin\report\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListDateReportGETController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $inicio = Carbon::parse($request->inicio)->format('Y-m-d');
            $final = Carbon::parse($request->final)->format('Y-m-d');

            $reports = Report::with('celula.lider')
            ->whereDate('datetime', '>=', $inicio )
            ->whereDate('datetime', '<=', $final)
            ->orderBy('id', 'desc')
            ->paginate(10);

            return response()->json([
                'status' => true,
                'reports' => $reports
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to list Report'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}