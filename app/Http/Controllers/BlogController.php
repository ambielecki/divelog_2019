<?php

namespace App\Http\Controllers;

use App\Models\Pages\BlogPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller {
    public function getAdminList(): View {

        return view('admin.blog.list');
    }

    public function getAdminCreate(): View {
        $page = new BlogPage();

        return view('admin.blog.create', ['page' => $page]);
    }

    public function postAdminCreate(Request $request): RedirectResponse {

        return redirect()->route('admin_blog_create');
    }

    public function getAdminEdit($id): View {

        return view('admin.blog.edit');
    }

    public function postAdminEdit(Request $request, $id): RedirectResponse {

        return redirect()->route('admin_blog_edit', ['id' => $id]);
    }
}
