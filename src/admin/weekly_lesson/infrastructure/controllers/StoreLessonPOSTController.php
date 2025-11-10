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
                $tema = str_replace(' ', '_', $request->tema); // Reemplazar espacios por guiones bajos
                $date = now()->format('Ymd'); // Formato de fecha AAAAMMDD
                $fileName = "{$tema}_{$date}." . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('public/lecciones', $fileName);
                $pdfUrl = Storage::url($filePath);
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
