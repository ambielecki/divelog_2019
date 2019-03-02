<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HeartbeatController extends Controller {
    public function postHeartbeat(Request $request): JsonResponse {
        return response()->json([
            'message' => 'lubdub',
        ]);
    }
}
