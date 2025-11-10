<?php

namespace Src\admin\home\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

final class MembersTipeGETController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $totalMembers = DB::table('members')
                ->join('celulas', 'members.celula_id', '=', 'celulas.id')
                ->select('celulas.tipe', DB::raw('COUNT(members.id) as total_members'))
                ->where('members.tipe', '<>', 2)
                ->groupBy('celulas.tipe')
                ->get();

            $tipes = [];
            $total = [];

            foreach ($totalMembers as $member) {
                switch ($member->tipe) {
                    case 1:
                        $tipe = 'Varones';
                        break;

                    case 2:
                        $tipe = 'Mujeres';
                        break;

                    case 3:
                        $tipe = 'Niños';
                        break;
                }

                $tipes[] = $tipe;
                $total[] = $member->total_members;
            }

            return response()->json([
                'tipe' => $tipes,
                'total' => $total,
                'status' => true,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'error al mostrar datos',
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
