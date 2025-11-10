<?php

namespace Src\admin\excel\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InformeExport;
use Carbon\Carbon;

final class ReportExportController extends Controller { 

    public function exportCSV(Request $request)
    {
        $date = [
            'inicio' => $request->input('inicio'),
            'final' => $request->input('final')
        ];
        
        return Excel::download(new InformeExport($date), 'reports.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportXLS(Request $request)
    {
        $date = [
            'inicio' => Carbon::parse($request->input('inicio'))->format('Y-m-d'),
            'final' => Carbon::parse($request->input('final'))->format('Y-m-d'),
        ];

        return Excel::download(new InformeExport($date), 'reports.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

}