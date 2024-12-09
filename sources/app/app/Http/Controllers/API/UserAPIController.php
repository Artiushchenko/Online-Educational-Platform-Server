<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use Illuminate\Http\JsonResponse;

class UserAPIController extends Controller
{
    public function showUserStatistics(): JsonResponse
    {
        $user = auth()->user();

        $totalLectures = Lecture::count();
        $viewedLectures = $user->viewedLectures()->count();

        return response()->json([
            'progress' => $totalLectures > 0 ? ($viewedLectures / $totalLectures) * 100 : 0
        ]);
    }

    public function showUserData(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'user_name' => $user->name,
            'user_role' => $user->role->name
        ]);
    }
}
