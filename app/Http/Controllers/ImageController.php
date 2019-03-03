<?php

namespace App\Http\Controllers;

use App\Helpers\CommandUtility;
use App\Http\Requests\ImageCreateRequest;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;

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
            ->pluck('name', 'id');

        return view('admin.images.create', [
            'image' => $image,
            'tags'  => $tags,
        ]);
    }

    public function postAdminCreate(ImageCreateRequest $request): RedirectResponse {
        $id = Image::createImage($request);
        if ($id !== 0) {
            $image = Image::find($id);

            $new_tags = explode(',', str_replace(' ', '', $request->input('new_tags')));
            $new_tag_ids = Tag::createNewTags($new_tags);
            $existing_tags = $request->input('tags') ?: [];
            $tags = array_unique(array_merge($existing_tags, $new_tag_ids));
            $image->tags()->attach($tags);

            CommandUtility::runBackgroundCommand("php artisan divelog:resize_image --id=$image->id");

            Session::flash('flash_success', 'Image Uploaded Successfully');

            return redirect()->route('admin_image_list');
        }

        Session::flash('flash_warning', 'There was a problem saving your image, please try again');
        return redirect()->back()->withInput();
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
