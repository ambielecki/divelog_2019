<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiveLogController extends Controller
{
    public function getApp(): View {
        return view('main.dive_log.app');
    }

    public function getApiList(): JsonResponse {
        return response()->json();
    }

    public function getApiCreate(): JsonResponse {
        return response()->json([
            'dive_number' => 1,
        ]);
    }

    public function postApiCreate($id): JsonResponse {
        return response()->json();
    }

    public function getApiEdit($id): JsonResponse {
        return response()->json();
    }

    public function postApiEdit($id): JsonResponse {
        return response()->json();
    }

    public function postApiUser(): JsonResponse {
        return response()->json([
            'user' => auth()->user(),
        ]);
    }
}
