<?php

namespace App\Http\Controllers;

use Ambielecki\DiveCalculator\DiveCalculator;
use App\Http\Requests\DiveCalculatorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DiveCalculatorController extends Controller {
    public function getIndex(): View {
        $dive_calculator = new DiveCalculator();

        return view('main.calculator.index', [
            'table_1_header'   => $dive_calculator->getTableDepths(),
            'table_1_body'     => $dive_calculator->getTableOne(),
            'table_2_3_header' => $dive_calculator->getTableGroups(),
            'table_2_body'     => $dive_calculator->getTableTwo(),
            'table_3_body'     => $dive_calculator->getTableThree(),
        ]);
    }

    public function getApiCalculation(DiveCalculatorRequest $request): JsonResponse {
        return response()->json([]);
    }
}
