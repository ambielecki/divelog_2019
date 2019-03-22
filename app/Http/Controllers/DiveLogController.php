<?php

namespace App\Http\Controllers;

use App\Models\DiveLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiveLogController extends Controller {
    public function getApp(): View {
        return view('main.dive_log.app');
    }

    public function getApiList(): JsonResponse {
        return response()->json();
    }

    public function postApiNextDiveInfo(): JsonResponse {
        if (auth()->user()) {
            $dive_number = DiveLog::query()
                ->where([
                    ['user_id', auth()->user()->id],
                ])
                ->max('dive_number');
        } else {
            $dive_number = 0;
        }

        return response()->json([
            'dive_number' => $dive_number + 1,
        ]);
    }

    public function postApiCreate(): JsonResponse {
        return response()->json();
    }

    public function postApiEditInfo($id): JsonResponse {
        return response()->json();
    }

    public function postApiEdit($id): JsonResponse {
        return response()->json();
    }

    public function postApiUser(): JsonResponse {
        return response()->json([
            'user' => auth()->user() ?? (object) [],
        ]);
    }
}
