<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    public function showCabinet(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'user_name' => $user->name,
            'user_role' => $user->role->name
        ]);
    }
}
