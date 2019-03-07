<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller {
    public function getAdminList(): View {

        return view('');
    }

    public function getAdminCreate(): View {

        return view('');
    }

    public function postAdminCreate(Request $request): RedirectResponse {

        return redirect()->route('admin_blog_create');
    }

    public function getAdminEdit($id): View {

        return view('');
    }

    public function postAdminEdit(Request $request, $id): RedirectResponse {

        return redirect()->route('admin_blog_edit', ['id' => $id]);
    }
}
