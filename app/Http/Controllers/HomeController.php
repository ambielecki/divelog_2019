<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class HomeController extends Controller {
    public function getHome(): View {
        $page = Page::where([
            ['page_type', 'home'],
            ['is_active', true],
        ])
            ->orderBy('revision', 'DESC')
            ->first();

        $content = $page->content ?? [];
        unset($page['content']);

        return view('main.home.home', [
            'page'    => $page,
            'content' => $content,
        ]);
    }
}
