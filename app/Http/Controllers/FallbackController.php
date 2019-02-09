<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FallbackController extends Controller {
    public function getAdminFallback() {
        return 'hi';
    }

    public function getWebFallback(): View {
        return view('main');
    }
}
