<?php

namespace App\Http\Controllers;

use Ambielecki\DiveCalculator\DiveCalculator;
use App\Http\Requests\DiveCalculatorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DiveCalculatorController extends Controller {
    public function getIndex(): View {
        $dive_calculator = new DiveCalculator();

        return view('main.calculator.calculator', [
            'table_1_header'   => $dive_calculator->getTableDepths(),
            'table_1_body'     => $dive_calculator->getTableOne(),
            'table_2_3_header' => $dive_calculator->getTableGroups(),
            'table_2_body'     => $dive_calculator->getTableTwo(),
            'table_3_body'     => $dive_calculator->getTableThree(),
        ]);
    }

    public function getApiCalculation(DiveCalculatorRequest $request): JsonResponse {
        // initialize return variables
        $dive_1_max_time = null;
        $dive_1_pg = null;
        $post_si_pg = null;
        $rnt = null;
        $dive_2_max_time = null;
        $dive_2_pg = null;

        // get variables from request
        $dive_1_depth = $request->input('dive_1_depth');
        $dive_1_time = $request->input('dive_1_time');
        $surface_interval = $request->input('surface_interval');
        $dive_2_depth = $request->input('dive_2_depth');
        $dive_2_time = $request->input('dive_2_time');

        $continue = true;
        $calculator = new DiveCalculator();

        if ($dive_1_depth) {
            $dive_1_max_time = $calculator->getMaxBottomTime($dive_1_depth);
        }

        if ($dive_1_depth && $dive_1_time) {
            $dive_1_pg = $calculator->getPressureGroup($dive_1_depth, $dive_1_time);
            if ($dive_1_pg === DiveCalculator::OVER_DEPTH || $dive_1_pg === DiveCalculator::OVER_NDL) {
                $continue = false;
            }
        }

        if ($continue && $dive_1_pg && $surface_interval) {
            $post_si_pg = $calculator->getNewPressureGroup($dive_1_pg, $surface_interval);
        }

        if ($continue && $post_si_pg && $dive_2_depth) {
            if ($post_si_pg === DiveCalculator::NO_RESIDUAL_NITROGEN) {
                $rnt = 0;
            } else {
                $rnt = $calculator->getResidualNitrogenTime($post_si_pg, $dive_2_depth);
            }

            if ($rnt === DiveCalculator::OFF_REPETITIVE_CHART) {
                $continue = false;
            } else {
                $dive_2_max_time = $calculator->getMaxBottomTime($dive_2_depth, $rnt);
            }
        }

        if ($continue && $rnt && $dive_2_depth && $dive_2_time) {
            $dive_2_pg = $calculator->getPressureGroup($dive_2_depth, $dive_2_max_time, $rnt);
        }

        return response()->json([
            'dive_1_max_time' => $dive_1_max_time,
            'dive_1_pg'       => $dive_1_pg,
            'post_si_pg'      => $post_si_pg,
            'rnt'             => $rnt,
            'dive_2_max_time' => $dive_2_max_time,
            'dive_2_pg'       => $dive_2_pg,
        ]);
    }
}
