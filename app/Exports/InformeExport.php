<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InformeExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Query to get the reports based on the date range
        return Report::whereBetween('datetime', [$this->date['inicio'], $this->date['final']])
            ->get()
            ->map(function ($report) {
                return [
                    'name_celula' => $report->name_celula,
                    'lider' => $report->celula->lider->name . ' ' . $report->celula->lider->lastname,
                    'datetime' => $report->datetime,
                    'assistant_amount' => $report->assistant_amount,
                    'visit_amount' => $report->visit_amount,
                    'offering' => number_format($report->offering, 2),
                    'address' => $report->address,
                ];
            });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Célula',
            'Líder',
            'Fecha y Hora',
            'Asistencia',
            'Visitas',
            'Ofrenda (Bs.)',
            'Dirección',
        ];
    }
}
