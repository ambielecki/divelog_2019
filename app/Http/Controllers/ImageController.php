<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tag;
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
        $image = new Image();
        $tags = Tag::query()
            ->orderBy('name', 'ASC')
            ->get();

        return view('admin.images.create', [
            'image' => $image,
            'tags'  => $tags,
        ]);
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
        return response()->json([
            'message' => 'hi there',
        ]);
    }

    public function getAdminApiView(): JsonResponse {
        return response()->json([]);
    }
}
