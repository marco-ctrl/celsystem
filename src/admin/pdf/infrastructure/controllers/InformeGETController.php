<?php

namespace Src\admin\pdf\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Dompdf\Dompdf;

final class InformeGETController extends Controller
{

    public function index(int $id)
    {
        $report = Report::find($id);

        $dompdf = new Dompdf();
        $html = view('pdf.informe', compact('report'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Devolver el PDF como una respuesta
        /*return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="informe.pdf"');*/

        return view('pdf.informe', compact('report'));
    }
}
