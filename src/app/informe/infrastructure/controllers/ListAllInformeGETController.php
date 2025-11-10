<?php

namespace Src\app\informe\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use App\Models\Report;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListAllInformeGETController extends Controller
{

    public function index(Request $request)
    {
        try {
            $term = $request->term;
            $lider = auth()->user()->lider;
            $celula = Celula::where('lider_id', $lider->id)->first();

            $reports = Report::with('celula.lider')
            ->where('celula_id', $celula->id)
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
