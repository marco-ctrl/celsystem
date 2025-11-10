<?php

namespace Src\admin\home\infrastructure\resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyAssistantAmountSumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $mes = '';
        switch ($this->month) {
            case '1':
                $mes = 'Enero';
                break;

            case '2':
                $mes = 'Febrero';
                break;

            case '3':
                $mes = 'Marzo';
                break;

            case '4':
                $mes = 'Abril';
                break;

            case '5':
                $mes = 'Mayo';
                break;

            case '6':
                $mes = 'Junio';
                break;

            case '7':
                $mes = 'Julio';
                break;

            case '8':
                $mes = 'Agosto';
                break;

            case '9':
                $mes = 'Septiembre';
                break;

            case '10':
                $mes = 'Octubre';
                break;

            case '11':
                $mes = 'Noviembre';
                break;

            case '12':
                $mes = 'Diciembre';
                break;

            default:
                # code...
                break;
        }

        return [
            'label' => $mes,
            'data' => $this->total_assistant_amount,
        ];
    }
}
