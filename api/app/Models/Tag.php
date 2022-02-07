<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\ResponseCache\Facades\ResponseCache;

class Tag extends Model
{
    use Uuids, HasTranslations, SoftDeletes;

    public $translatable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(\App\Models\Post::class, 'posts_tags')
        ->withPivot('id')
        ->withTimestamps();
    }

    public function tests()
    {
        return $this->belongsToMany(\App\Models\Test::class, 'tests_tags')
        ->withPivot('id')
        ->withTimestamps();
    }

    public function getDisplayAttribute()
    {
        return $this->getTranslation('name', 'fr');
    }

    protected static function booted()
    {
        static::created(function ($post) {
            ResponseCache::clear();
        });
        static::updated(function ($post) {
            ResponseCache::clear();
        });
        static::deleted(function ($post) {
            ResponseCache::clear();
        });
    }
}
