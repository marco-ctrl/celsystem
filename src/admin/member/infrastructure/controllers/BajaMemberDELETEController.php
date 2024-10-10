<?php

namespace Src\admin\member\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class BajaMemberDELETEController extends Controller
{
    public function index(Member $member): JsonResponse
    {
        try {
            if ($member->status == 0) {
                $member->status = 1;
                $member->save();

                $message = 'Miembro dado de alta correctamente';
            } else {
                $member->status = 0;
                $member->save();

                $message = 'Miembro dado de baja correctamente';
            }


            return response()->json([
                'status' => true,
                'message' => $message,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'error al dar de baja Miembro',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}