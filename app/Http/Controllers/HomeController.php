<?php

namespace App\Http\Controllers;

use App\Models\Pages\HomePage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;

class HomeController extends Controller {
    public function getHome(): View {
        $page = HomePage::where([
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
    public function getEdit($id = null): View {
        if ($id) {
            $current_page = HomePage::find($id);
        } else {
            $current_page = HomePage::query()
                ->where([
                    ['is_active', 1],
                ])
                ->orderBy('revision', 'DESC')
                ->first();
        }

        return view('admin.home.home', [
            'current_page' => $current_page,
            'content'      => $current_page->content,
        ]);
    }

    public function postEdit(Request $request) {
        $last_page = HomePage::query()
            ->orderBy('id', 'DESC')
            ->first();

        $page = new HomePage();
        $page->revision = $last_page->revision + 1;
        $page->is_active = 1;
        $page->content = $request->input('content');
        $page->title = $request->input('title');

        if ($page->save()) {
            $id = $page->id;
            Session::flash('flash_success', 'Home Page Saved');
        } else {
            Session::flash('flash_error', 'Error Saving Home Page');
        }

        return redirect()->route('admin_home_edit');
    }
}
