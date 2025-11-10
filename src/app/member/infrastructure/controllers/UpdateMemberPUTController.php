<?php

namespace Src\app\member\infrastructure\controllers;

use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Src\app\member\infrastructure\validators\UpdateMemberRequest;
use Symfony\Component\HttpFoundation\Response;

final class UpdateMemberPUTController
{
    public function index(Member $member, UpdateMemberRequest $request): JsonResponse
    {
        try {

            $members = Member::find($member->id)->update([
                'name' => strtoupper($request->name),
                'lastname' => strtoupper($request->lastname),
                'contact' => $request->contact,
                'tipe' => $request->tipe,
                'status' => 1,
        ]);

            //$member->save();

            return response()->json([
                'status' => true,
                'message' => 'Miembro modificado correctamente',
                'data' => $members,
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
