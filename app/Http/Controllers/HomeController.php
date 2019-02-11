<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller {
    public function getHome(): View {
        $page = Page::where([
            ['page_type', 'home'],
            ['is_active', true],
        ])
            ->orderBy('revision', 'DESC')
            ->first();

        return view('main.home.index', ['page' => $page]);
    }
}
