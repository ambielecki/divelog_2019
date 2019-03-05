<?php

namespace App\Http\Controllers;

use App\Models\Image;
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

//        $hero_image_content = $content['hero_image'] ?? [];
//        $hero_image = false;
//        if ($hero_image_content) {
//            $hero_image = Image::find($hero_image_content['id']);
//        }

        return view('main.home.home', [
            'page'       => $page,
            'content'    => $content,
//            'hero_image' => $hero_image,
        ]);
    }

    // this is restricted to admins in web.php
    public function getEdit(): View {
        return view('admin.home.home');
    }
}
