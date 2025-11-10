<?php

namespace Src\app\member\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowMemberGETController extends Controller
{
    public function index(Member $member): JsonResponse
    {
        try {
            $members = Member::with('celula')->find($member->id);

            return response()->json([
                'status' => true,
                'member' => $members,
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