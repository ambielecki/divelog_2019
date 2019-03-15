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
        $post = BlogPage::query()
            ->where([
                ['slug', $slug],
                ['is_active', 1]
            ])
            ->orderBy('id', 'DESC')
            ->first();

        if (!$post) {
            abort(404, 'Post Not Found');
        }

        $post = BlogPage::processContent($post);

        return view('main.blog.view', [
            'post'    => $post,
            'content' => $post->content,
        ]);
    }

    public function getList(): View {
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

        $posts = $posts->map(function ($post) {
            return BlogPage::processContent($post);
        });

        return response()->json([
            'posts' => $posts,
            'page'  => (int) $page,
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

        $post = new BlogPage();
        $post = BlogPage::processPost($post, $request, $slug);

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
        $original_post = BlogPage::find($id);
        $slug = BlogPage::getSlug($request->input('title'));

        if ($slug !== $original_post->slug && !BlogPage::checkSlug($slug)) {
            return back()->withInput()->withErrors(['slug' => 'Slug is not unique, please resubmit with new title']);
        }

        $post = new BlogPage();
        $post = BlogPage::processPost($post, $request, $slug, $original_post);

        if ($post->save()) {
            BlogPage::query()
                ->where('slug', $original_post->slug)
                ->where('id', '<>', $post->id)
                ->update(['is_active' => 0]);

            Session::flash('flash_success', 'Post edited successfully');

            return redirect()->route('admin_blog_edit', ['id' => $post->id]);
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
