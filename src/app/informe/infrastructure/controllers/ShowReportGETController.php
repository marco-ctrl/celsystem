<?php

namespace Src\app\informe\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowReportGETController extends Controller
{
    public function index(Report $report): JsonResponse
    {
        try {
            //$term = $request->term;
            //dd($report->id);

            $reports = Report::with('celula.lider', 'asistencia', 'visita')
            ->find($report->id);

            return response()->json([
                'status' => true,
                'report' => $reports,
                //'asistencia' => $reports->asistencia->asistente,
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