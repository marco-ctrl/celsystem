<?php

namespace Src\admin\member\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListAllMemberGETController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $term = $request->term;

            $members = Member::with('celula')
            ->where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('name', 'LIKE', '%' . $term . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

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