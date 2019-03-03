<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model {
    protected $fillable = ['name',];

    public function setNameAttribute($value): void {
        $this->attributes['name'] = strtolower($value);
    }

    public function images(): BelongsToMany {
        return $this->belongsToMany(Image::class)->withTimestamps();
    }

    public static function createNewTags(array $tags): array {
        $ids = [];

        foreach ($tags as $tag_name) {
            if ($tag_name) {
                $tag = Tag::where('name', $tag_name)->first();
                if (!$tag) {
                    $tag = self::create(['name' => strtolower($tag_name)]);
                }

                $ids[] = $tag->id;
            }
        }

        return $ids;
    }
}
