<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\Uuids;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;

use App\Models\States\Test\Finished;
use App\Models\States\Test\OnPause;
use App\Models\States\Test\Open;
use App\Models\States\Test\Soon;

use App\Helpers\ContentParser;

use Spatie\ResponseCache\Facades\ResponseCache;

class Test extends Model
{
    use Uuids, HasTranslations, SoftDeletes, Searchable;

    public static $states = [
        Soon::class,
        Open::class,
        OnPause::class,
        Finished::class,
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public $translatable = [
        'title',
        'content',
        'slug',
        'excerpt',
        'featuredalt',
    ];

    protected $hidden = [
        'searchable',
    ];

    public function searchableOptions()
    {
        return [
            'column' => 'searchable',
            'external' => true,
            'maintain_index' => true,
            'rank' => [
                'fields' => [
                    'title' => 'A',
                ],
                'weights' => [0.1, 0.2, 0.4, 1.0],
                'function' => 'ts_rank_cd',
                'normalization' => 32,
            ],
            'config' => 'simple',
        ];
    }

    public function getPublishedAtAttribute() {
        return $this->start_at;
    }

    public function toSearchableArray()
    {
        return [
            'titlefr' => $this->getTranslation('title', 'fr'),
            'titleen' => $this->getTranslation('title', 'en'),
            'content_fr' => $this->content_fr ?? null,
            'content_en' => $this->content_en ?? null,
            'tagsfr' => self::parseTagsForSearch($this->tags, 'fr'),
            'tagsen' => self::parseTagsForSearch($this->tags, 'en'),
            'excerptfr' => $this->getTranslation('excerpt', 'fr'),
            'excerpten' => $this->getTranslation('excerpt', 'en'),
        ];
    }

    public static function parseStatus($object): string
    {
        if (now() > $object->end_at) {
            return Finished::$key;
        } elseif (now() < $object->start_at) {
            return Soon::$key;
        }
        if ($object->paused) {
            return OnPause::$key;
        }
        return Open::$key;
    }

    public static function parseTagsForSearch($tags, $lang)
    {
        return $tags->map(function ($el) use ($lang) {
            return $el->getTranslation('name', $lang);
        })->implode(' ');
    }

    public function status(): string
    {
        return self::parseStatus($this);
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'tests_tags')
        ->withPivot('id')
        ->withTimestamps();
    }

    public function votes()
    {
        return $this->hasMany('App\Models\Vote');
    }

    public function sponsor()
    {
        return $this->belongsTo(\App\Models\Sponsor::class);
    }

    protected static function booted()
    {
        static::saving(function ($test) {
            $test->content_fr = is_null($test->content_fr)
            ? json_encode(["time"=> time(), 'blocks' => []]) : $test->content_fr;
            $test->content_en = is_null($test->content_en)
            ? json_encode(["time"=> time(), 'blocks' => []]) : $test->content_en;
        });
        static::creating(function ($test) {
            $test = ContentParser::slugify($test);
        });
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
