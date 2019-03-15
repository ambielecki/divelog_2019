<?php

namespace App\Models\Pages;

use App\Http\Requests\BlogRequest;
use App\Models\Image;
use App\Models\Page;
use App\Scopes\BlogPageScope;

class BlogPage extends Page {
    public const PAGE_TYPE = 'blog';

    private const PARAGRAPH_REGEX = '/\<p\>.*?\<\/p\>/';
    private const IMAGE_REGEX = '/\|\|--(.*?)--\|\|/';
    private const IMAGE_INSERT_REGEX = '/\<p\>\|\|-- (.*?) --\|\|\<\/p\>/';
    private const IMAGE_TEMPLATE = <<<IMAGE
<div class="col m4 s12 left" style="clear: both">
    <img class="materialboxed responsive-img" src="%s" title="%s" alt="%s">
</div>
IMAGE;


    protected static function boot(): void {
        parent::boot();

        static::addGlobalScope(new BlogPageScope());

        static::creating(function ($query) {
            $query->page_type = self::PAGE_TYPE;
        });
    }

    public function getContentAttribute($value): array {
        return json_decode($value, true);
    }

    public static function getSlug(string $title): string {
        $slug = strtolower($title);
        $slug = str_replace("'", '', $slug);
        $slug = preg_replace('~[^\\pL0-9_]+~u', '-', $slug);
        $slug = preg_replace('~[^-a-z0-9_]+~', '', $slug);

        return $slug . date('-Y-m-d');
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

    public static function processPost(BlogPage $post, BlogRequest $request, string $slug, BlogPage $original_page = null): BlogPage {
        $ids = BlogPage::getImageIds($request->input('content.content'));

        $content = $request->input('content');
        $content['image_ids'] = $ids;

        $post->title = $request->input('title');
        $post->slug = $slug;
        $post->content = $content;
        $post->is_active = $request->input('is_active') ?: 0;
        $post->revision = $original_page ? $original_page->revision + 1 : 1;
        if ($original_page) {
            $post->parent_id = $original_page->parent_id ?? $original_page->id;
        }

        return $post;
    }

    public static function processContent(BlogPage $post, bool $replace_as_image = true): BlogPage {
        $post_content = $post->content;
        $content = $post_content['content'] ?: '';

        // fix images
        preg_match_all(self::IMAGE_INSERT_REGEX, $content, $matches);

        if ($matches) {
            $images = Image::find($matches[1]) ?? [];

            if ($images) {
                $images = $images->keyBy('id')->all();
            }

            foreach ($matches[0] as $key => $match) {
                $replacement = '';

                if ($replace_as_image) {
                    $image_id = $matches[1][$key];
                    $replacement_image = $images[$image_id];
                    $src = $replacement_image->has_sizes
                        ? '/' . $replacement_image->folder . 'medium/' . $replacement_image->file_name
                        : '/' . $replacement_image->folder . $replacement_image->file_name;

                    $replacement = sprintf(self::IMAGE_TEMPLATE, $src, $replacement_image->title, $replacement_image->description);
                }


                $content = str_replace($match, $replacement, $content);
            }
        }

        $post_content['content'] = $content;

        // get first <p>
        preg_match(self::PARAGRAPH_REGEX, $content, $paragraph);
        $post_content['first_paragraph'] = $paragraph[0] ?? '';

        $post->content = $post_content;

        return $post;
    }
}
