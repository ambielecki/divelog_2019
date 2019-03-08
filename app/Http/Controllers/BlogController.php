<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Pages\BlogPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;

class BlogController extends Controller {
    public function getView($slug): View {
        return view('main.blog.view');
    }

    public function getList($slug): View {
        return view('main.blog.list');
    }

    public function getApiList(Request $request): JsonResponse {
        $search = $request->get('search');
        $page = $request->get('page') ?: 1;
        $limit = $request->get('limit') ?: 20;
        $skip = ($page - 1) * $limit;

        $query = BlogPage::query()
            ->where('is_active', 1)
            ->orderBy('id', 'DESC');

        if ($search) {
            $search = '%' . $search . '%';
            $query = $query->where('title', 'LIKE', $search);
        }

        $count = $query->count();

        $posts = $query
            ->limit($limit)
            ->skip($skip)
            ->get();

        return response()->json([
            'posts' => $posts,
            'page'  => $page,
            'pages' => ceil($count / $limit),
            'count' => $count,
        ]);
    }

    public function getAdminList(): View {

        return view('admin.blog.list');
    }

    public function getAdminCreate(): View {
        $page = new BlogPage();

        return view('admin.blog.create', [
            'content' => [],
            'page'    => $page,
        ]);
    }

    public function postAdminCreate(BlogRequest $request): RedirectResponse {
        $slug = BlogPage::getSlug($request->input('title'));

        if (!BlogPage::checkSlug($slug)) {
            return back()->withInput()->withErrors(['slug' => 'Slug is not unique, please resubmit with new title']);
        }

        $ids = BlogPage::getImageIds($request->input('content.content'));

        $content = $request->input('content');
        $content['image_ids'] = $ids;

        $post = new BlogPage();
        $post->title = $request->input('title');
        $post->slug = $slug;
        $post->content = $content;
        $post->is_active = $request->input('is_active') ?: 0;
        $post->revision = 1;

        if ($post->save()) {
            Session::flash('flash_success', 'Post created successfully');

            return redirect()->route('admin_blog_edit', ['id' => $post->id]);
        }

        Session::flash('flash_error', 'There was a problem saving your post');

        return back()->withInput();
    }

    public function getAdminEdit($id): View {
        $post = BlogPage::find($id);

        return view('admin.blog.edit', [
            'content' => $post->content,
            'page'    => $post,
        ]);
    }

    public function postAdminEdit(BlogRequest $request, $id): RedirectResponse {
        $post = BlogPage::find($id);
        $slug = BlogPage::getSlug($request->input('title'));

        if ($slug !== $post->slug && !BlogPage::checkSlug($slug)) {
            return back()->withInput()->withErrors(['slug' => 'Slug is not unique, please resubmit with new title']);
        }

        $ids = BlogPage::getImageIds($request->input('content.content'));

        $content = $request->input('content');
        $content['image_ids'] = $ids;

        $post->title = $request->input('title');
        $post->slug = $slug;
        $post->content = $content;
        $post->is_active = $request->input('is_active') ?: 0;
        $post->revision++;

        if ($post->save()) {
            Session::flash('flash_success', 'Post edited successfully');

            return redirect()->route('admin_blog_edit', ['id' => $id]);
        }

        Session::flash('flash_error', 'There was a problem saving your post');

        return back()->withInput();
    }

    public function postAdminApiSlugCheck(Request $request): JsonResponse {
        $slug = BlogPage::getSlug($request->input('title'));
        $error = !BlogPage::checkSlug($slug);

        return response()->json([
            'slug'  => $slug,
            'error' => $error,
        ]);
    }
}
