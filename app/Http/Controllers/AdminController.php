<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller {
    public function getIndex(): View {
        return view('admin.index');
    }
}
