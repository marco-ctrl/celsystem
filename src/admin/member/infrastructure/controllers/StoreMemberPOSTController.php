<?php

namespace Src\admin\member\infrastructure\controllers;

use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Src\admin\member\infrastructure\validators\StoreMemberRequest;
use Symfony\Component\HttpFoundation\Response;

final class StoreMemberPOSTController
{
    public function index(StoreMemberRequest $request): JsonResponse
    {
        try {

            $member = Member::create([
                    'name' => strtoupper($request->name),
                    'lastname' => strtoupper($request->lastname),
                    'contact' => $request->contact,
                    'tipe' => $request->tipe,
                    'celula_id' => $request->celula_id,
                    'status' => 1,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Miembro creado correctamente',
                'data' => $member,
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'error al guardar miembro',
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}