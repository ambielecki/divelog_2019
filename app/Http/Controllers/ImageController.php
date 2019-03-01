<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImageController extends Controller
{
    // Admin Functionality
    public function getAdminList(): View {
        return view('admin.images.list');
    }

    public function getAdminCreate(): View {
        return view('admin.images.create');
    }

    public function postAdminCreate(): RedirectResponse {
        return redirect(route('admin_image_list'));
    }

    public function getAdminEdit(): View {
        return view('admin.images.edit');
    }

    public function postAdminEdit():RedirectResponse {
        return redirect(route('admin_image_list'));
    }

    public function getAdminApiList(): JsonResponse {
        return response()->json([]);
    }

    public function getAdminApiView(): JsonResponse {
        return response()->json([]);
    }
}
