<?php

namespace Src\admin\weekly_lesson\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\WeeklyLesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListAllLessonGETController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $lessons = WeeklyLesson::where('tema', 'LIKE', '%' . $request->term . '%')
            ->orWhere('description', 'LIKE', '%' . $request->term . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

            return response()->json([
                'status' => true,
                'lessons' => $lessons,
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to list Lesson'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}