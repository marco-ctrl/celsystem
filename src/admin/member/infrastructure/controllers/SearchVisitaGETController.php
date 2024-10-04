<?php

namespace Src\admin\member\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Celula;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

final class SearchVisitaGETController extends Controller
{
    public function index(Celula $celula, Request $request): JsonResponse
    {
        try {
            $term = $request->term;

            $members = Member::with('celula')
            ->where('celula_id', $celula->id)
            ->where('tipe', 2)
            ->where(function ($query) use ($term){
                $query->where('name', 'LIKE', '%' . $term . '%')
                ->orWhere('name', 'LIKE', '%' . $term . '%')
                ->orWhere(DB::raw("CONCAT(name, ' ', lastname)"), 'LIKE', '%' . $term . '%');
            })
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

            return response()->json([
                'status' => true,
                'members' => $members,
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to list Members'),
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}