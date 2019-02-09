<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {
    protected $fillable = ['slug', 'title', 'content', 'is_active'];

    public function getContentAttribute($value) {
        return json_decode($value, true);
    }

    public function setContentAttribute($value) {
        $this->attributes['content'] = json_encode($value);
    }
}
