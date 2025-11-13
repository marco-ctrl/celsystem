<?php

namespace Src\admin\weekly_lesson\infrastructure\controllers;

use App\Models\WeeklyLesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Src\admin\weekly_lesson\infrastructure\validators\StoreLessonRequest;
use Symfony\Component\HttpFoundation\Response;

final class StoreLessonPOSTController
{
    public function index(StoreLessonRequest $request): JsonResponse
    {
        try {
            // Manejar la subida del archivo
            $pdfUrl = null;
            if ($request->hasFile('file')) {

                $file = $request->file('file');

                // Quitar espacios del nombre del tema
                $tema = str_replace(' ', '_', $request->tema);

                // Fecha AAAAMMDD
                $date = now()->format('Ymd');

                // Nombre final del archivo
                $fileName = "{$tema}_{$date}." . $file->getClientOriginalExtension();

                // Carpeta destino en /public
                $folder = 'lecciones';

                // Crear carpeta si no existe
                if (!file_exists(public_path($folder))) {
                    mkdir(public_path($folder), 0775, true);
                }

                // Ruta física donde se guardará el archivo
                $file->move(public_path($folder), $fileName);

                // URL pública que guardarás en BD
                $pdfUrl = $folder . '/' . $fileName;
            }


            // Guardar la URL en la base de datos
            $lesson = new WeeklyLesson();
            $lesson->archive = $pdfUrl;
            $lesson->tema = $request->tema;
            $lesson->description = $request->description;
            $lesson->date = now()->format('Y-m-d');
            $lesson->save();

            return response()->json([
                'status' => true,
                'message' => 'Leccion guardado correctamente',
                'data' => $lesson
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'error al guardar una nueva leccion',
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
