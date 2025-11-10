<?php

namespace Src\admin\pdf\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

final class AllInformeGETController extends Controller
{

    public function index(Request $request)
    {
        $inicio = Carbon::parse($request->inicio)->format('Y-m-d');
        $final = Carbon::parse($request->final)->format('Y-m-d');

        $reports = Report::with('celula.lider')
            ->whereDate('datetime', '>=', $inicio)
            ->whereDate('datetime', '<=', $final)
            ->orderBy('id', 'desc')
            ->get();

        $date = [
            "inicio" => $inicio,
            "final" => $final,
        ];

        $dompdf = new Dompdf();
        $html = view('pdf.all-informe', compact('reports', 'date'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Devolver el PDF como una respuesta
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="informe.pdf"');
    }
}
