<?php

namespace Src\admin\pdf\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use App\Models\Report;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

final class ReportCelulaGETController extends Controller
{

    public function index(Request $request)
    {
        $celulas = Celula::with('lider')
        ->where('tipe', $request->tipe)
        ->orderBy('id', 'desc')
        ->get();

    if ($request->tipe == 0) {
        $celulas = Celula::with('lider')
            ->orderBy('id', 'desc')
            ->get();
    }

        $dompdf = new Dompdf();
        $html = view('pdf.report-celulas', compact('celulas'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Devolver el PDF como una respuesta
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="celulas.pdf"');
    }
}
