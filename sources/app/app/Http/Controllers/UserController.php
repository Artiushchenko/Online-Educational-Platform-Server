<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser(): JsonResponse
    {
        return response()->json(Auth::user());
    }
}
