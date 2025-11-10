<?php

namespace Src\admin\report\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class BajaReportDELETEController extends Controller
{
    public function index(Report $report): JsonResponse
    {
        try {
            if ($report->status == 0) {
                $report->status = 1;
                $report->save();

                $message = 'Informe dado de alta correctamente';
            } else {
                $report->status = 0;
                $report->save();

                $message = 'Informe dado de baja correctamente';
            }


            return response()->json([
                'status' => true,
                'message' => $message,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'error al dar de baja este informe',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}