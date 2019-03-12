<?php

namespace App\Models\Pages;

use App\Http\Requests\BlogRequest;
use App\Models\Image;
use App\Models\Page;
use App\Scopes\BlogPageScope;

class BlogPage extends Page {
    const PAGE_TYPE = 'blog';

    const IMAGE_REGEX = '/\|\|--(.*?)--\|\|/';

    protected static function boot(): void {
        parent::boot();

        static::addGlobalScope(new BlogPageScope());

        static::creating(function ($query) {
            $query->page_type = self::PAGE_TYPE;
        });
    }

    public function getContentAttribute($value): array {
        $content = json_decode($value, true);

//        if (isset($content['hero_image'])) {
//            $hero_image = Image::find($content['hero_image']['id']);
//            $hero_image = $hero_image ? $hero_image->toArray() : [];
//
//            $content['hero_image'] = array_merge($hero_image, $content['hero_image']);
//        }
//
//        if (isset($content['carousel_images']['ids'])) {
//            $ids = explode(',', $content['carousel_images']['ids']);
//            $carousel_images = Image::query()
//                ->whereIn('id', $ids)
//                ->get()
//                ->toArray();
//
//            $content['carousel_images']['images'] = $carousel_images;
//        }

        return $content;
    }

    public static function getSlug(string $title): string {
        $slug = strtolower($title);
        $slug = str_replace("'", '', $slug);
        $slug = preg_replace('~[^\\pL0-9_]+~u', '-', $slug);
        $slug = preg_replace('~[^-a-z0-9_]+~', '', $slug);

        return $slug;
    }

    public static function checkSlug(string $slug): bool {
        return self::where('slug', $slug)->count() === 0;
    }

    public static function getImageIds($content): array {
        $regex = self::IMAGE_REGEX;
        preg_match_all($regex, $content, $matches);

        if ($matches) {
            $ids = array_map('trim', $matches[1]);
        } else {
            $ids = [];
        }

        return $ids;
    }

    public static function processPost(BlogPage $post, BlogRequest $request, string $slug, int $revision = null): BlogPage {
        $ids = BlogPage::getImageIds($request->input('content.content'));

        $content = $request->input('content');
        $content['image_ids'] = $ids;

        $post->title = $request->input('title');
        $post->slug = $slug;
        $post->content = $content;
        $post->is_active = $request->input('is_active') ?: 0;
        $post->revision = $revision ? $revision + 1 : 1;

        return $post;
    }
}
