<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiveCalculatorRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'dive_1_depth'     => 'numeric|nullable',
            'dive_1_time'      => 'numeric|nullable',
            'surface_interval' => 'numeric|nullable',
            'dive_2_depth'     => 'numeric|nullable',
            'dive_2_time'      => 'numeric|nullable',
        ];
    }

    public function messages(): array {
        return [
            'dive_1_depth.numeric'     => 'Dive 1 Depth Must Be a Number',
            'dive_1_time.numeric'      => 'Dive 1 Bottom Time Must Be a Number',
            'surface_interval.numeric' => 'Surface Interval Must Be a Number',
            'dive_2_depth.numeric'     => 'Dive 2 Depth Must Be a Number',
            'dive_2_time.numeric'      => 'Dive 2 Bottom Time Must Be a Number',
        ];
    }
}
