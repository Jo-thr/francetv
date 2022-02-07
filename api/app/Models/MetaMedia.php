<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Laravel\Scout\Searchable;

use Spatie\ResponseCache\Facades\ResponseCache;

class MetaMedia extends Model implements Sortable
{
    use SortableTrait, Uuids, Searchable;

    protected $casts = [
        'published_at' => 'datetime'
    ];

    protected $fillable = [
        'published_at',
        'title',
        'description',
    ];

    public $sortable = [
      'order_column_name' => 'sort_order',
      'sort_when_creating' => true,
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

    public function toSearchableArray()
    {
        return [
            'title' => $this->title ?? null,
            'description' => $this->description ?? null,
        ];
    }
}
