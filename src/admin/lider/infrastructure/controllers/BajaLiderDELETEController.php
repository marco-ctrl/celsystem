<?php

namespace Src\admin\lider\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Lider;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class BajaLiderDELETEController extends Controller
{
    public function index(Lider $lider): JsonResponse
    {
        try {
            if ($lider->status == 0) {
                $lider->status = 1;
                $lider->save();

                $message = 'Lider dado de alta correctamente';
            } else {
                $lider->status = 0;
                $lider->save();

                $message = 'Lider dado de baja correctamente';
            }


            return response()->json([
                'status' => true,
                'message' => $message,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'error al dar de baja este lider',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}