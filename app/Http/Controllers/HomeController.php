<?php

namespace App\Http\Controllers;

use App\Models\Pages\HomePage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller {
    public function getHome(): View {
        $page = HomePage::where([
            ['page_type', HomePage::PAGE_TYPE],
            ['is_active', true],
        ])
            ->orderBy('revision', 'DESC')
            ->first();

        $content = $page->content ?? [];
        unset($page['content']);

//        $hero_image_content = $content['hero_image'] ?? [];
//        $hero_image = false;
//        if ($hero_image_content) {
//            $hero_image = Image::find($hero_image_content['id']);
//        }

        return view('main.home.home', [
            'page'    => $page,
            'content' => $content,
//            'hero_image' => $hero_image,
        ]);
    }

    // this is restricted to admins in web.php
    public function getEdit(): View {
        $current_page = HomePage::query()
            ->where([
                ['page_type', HomePage::PAGE_TYPE],
                ['is_active', 1],
            ])
            ->orderBy('revision', 'DESC')
            ->first();

        return view('admin.home.home', [
            'current_page' => $current_page,
            'content'      => $current_page->content,
        ]);
    }

    public function postEdit(Request $request) {
        $test = 'test';

        return redirect()->route('admin_home_edit');
    }
}
