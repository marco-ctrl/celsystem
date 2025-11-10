<?php

namespace Src\app\informe\infrastructure\controllers;

use App\Models\Assistant;
use App\Models\Member;
use App\Models\Report;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Src\app\informe\infrastructure\validators\StoreInformeRequest;

final class StoreInformePOSTController
{
    public function index(StoreInformeRequest $request): JsonResponse
    {
        try {
            // Logic to store the informe would go here

            $asistentes = $request->input('asistencia', []);
            $visitas = $request->input('visita', []);

            // Manejar la subida del archivo
            $photoUrl = null;
            $voucherUrl = null;
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filePath = $file->store('public/photos_informe/' . now()->format('Y-m-d'));
                $photoUrl = Storage::url($filePath);
            }

            if ($request->hasFile('voucher')){
                $file = $request->file('voucher');
                $filePath = $file->store('public/voucher_informe' . now()->format('Y-m-d'));
                $voucherUrl = Storage::url($filePath);
            }

            // Crear un nuevo registro de informe
            $informe = Report::create([
                'celula_id' => $request->input('celula_id'),
                'offering' => $request->input('offering'),
                'photo' => $photoUrl,
                'datetime' => now()->format('Y-m-d H:m:s'),
                'assistant_amount' => 0,
                'visit_amount' => 0,
                'payment_method' => $request->input('payment_method'),
                'voucher' => $voucherUrl,
                'name_celula' => mb_strtoupper($request->input('celula'), 'UTF-8'),
                'lider' => mb_strtoupper($request->input('lider'), 'UTF-8'),
                'latitude' => $request->input('latitude'),
                'length' => $request->input('length'),
                'status' => 1,
                'address' => mb_strtoupper($request->input('addres'), 'UTF-8'),
                
            ]);

            // Manejar asistentes
            foreach ($asistentes as $asistenteData) {
                if ($asistenteData['id'] != 'null' && $asistenteData['id'] != '') {

                    $miembro = Member::find($asistenteData['id'])
                        ->update(['tipe' => 0]);

                    $asistencia = Assistant::create([
                        'member_id' => $asistenteData['id'],
                        'report_id' => $informe->id
                    ]);
                } else {
                    // Crear un nuevo asistente
                    $asistente = Member::create([
                        'name' => strtoupper($asistenteData['name']),
                        'lastname' => strtoupper($asistenteData['lastname']),
                        'contact' => $asistenteData['contact'],
                        'tipe' => 0,
                        'celula_id' => $asistenteData['celula_id'],
                    ]);

                    $asistencia = Assistant::create([
                        'member_id' => $asistente->id,
                        'report_id' => $informe->id
                    ]);
                }
            }

            // Manejar visitas
            foreach ($visitas as $visitaData) {
                if ($visitaData['id'] != 'null' && $visitaData['id'] != '') {
                    // Actualizar la visita existente
                    $visit = Visit::create([
                        'member_id' => $visitaData['id'],
                        'report_id' => $informe->id
                    ]);
                } else {
                    // Crear una nueva visita
                    $visita = Member::create([
                        'name' => strtoupper($visitaData['name']),
                        'lastname' => strtoupper($visitaData['lastname']),
                        'contact' => $visitaData['contact'],
                        'tipe' => 2,
                        'celula_id' => $visitaData['celula_id'],
                    ]);
                    $visit = Visit::create([
                        'member_id' => $visita->id,
                        'report_id' => $informe->id
                    ]);
                }
            }

            $informe->update([
                'assistant_amount' => $asistencia->where('report_id', $informe->id)->count(),
                'visit_amount' => $visit->where('report_id', $informe->id)->count(),
            ]);

            $informe->save();

            return response()->json([
                'status' => true,
                'message' => 'Informe stored successfully',
                'informe' => $informe,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error storing informe',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}