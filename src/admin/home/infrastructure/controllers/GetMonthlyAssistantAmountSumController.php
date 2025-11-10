<?php

namespace Src\admin\home\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\admin\home\infrastructure\resources\MonthlyAssistantAmountSumResource;
use Symfony\Component\HttpFoundation\Response;

class GetMonthlyAssistantAmountSumController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $year = $request->input('year'); // Asumiendo que el año viene como un parámetro en la solicitud

        if (!$year) {
            return response()->json([
                'status' => false,
                'message' => 'Year parameter is required'], 
            Response::HTTP_BAD_REQUEST);
        }

        $results = Report::getMonthlyAssistantAmountSumByYear($year);

        // Arrays para los resultados
        //$months = [];
        //$totalAssistantAmounts = [];

        // Mapeo de números de mes a nombres en español
        if($results->isEmpty()){
            return response()->json([
                'message' => 'No hay datos para el año especificado',
                'status' => false,
            ], Response::HTTP_OK);
        }
        $monthNames = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];

        foreach ($results as $result) {
            $months[] = $monthNames[$result->month]; // Reemplaza el número del mes por su nombre en español
            $totalAssistantAmounts[] = $result->total_assistant_amount;
        }

        return response()->json([
            'label' => $months,
            'data' => $totalAssistantAmounts,
            'status' => true,
        ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error al listar datos de card',
                'error' => $th->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
    }
}
