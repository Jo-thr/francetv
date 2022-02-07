<?php

namespace App\Models;

use App\Helpers\ContentParser;
use App\Models\States\Category\Article;
use App\Models\States\Category\Contribution;
use App\Models\States\Category\External;
use App\Models\States\PublicationStatus\Draft;
use App\Models\States\PublicationStatus\Pending;
use App\Models\States\PublicationStatus\Published;
use App\Models\States\StateHelper;
use App\Models\States\Type\Read;
use App\Models\Traits\Uuids;
use Chelout\RelationshipEvents\Concerns\HasBelongsToManyEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Laravel\Scout\Searchable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\ResponseCache\Facades\ResponseCache;
use Spatie\Translatable\HasTranslations;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class Post extends Model implements Sortable
{
    use Uuids, HasTranslations, SortableTrait, Searchable, SoftDeletes, HasBelongsToManyEvents;
    
    public static $categoryStates = [
        Article::class,
        External::class,
        Contribution::class,
    ];
    
    public static $columns = [
        'id', 'type', 'category',
        'sort_order', 'slug',
        'title', 'excerpt',
        'featured', 'featuredalt',
        'url', 'heading', 'time',
        'published_at', 'pictogram_id',
    ];
    
    public static $publicationStates = [
        Draft::class,
        Pending::class,
        Published::class,
    ];
    
    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];
    public $translatable = [
        'title',
        'slug',
        'contribution',
        'excerpt',
        'featuredalt',
    ];
    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'time' => 'time',
    ];
    protected $fillable = [
        'title',
        'content_fr',
        'content_en',
        'content_fr_v2_top',
        'content_en_v2_top',
        'content_fr_v2_bottom',
        'content_en_v2_bottom',
        'heading',
        'slug',
        'contribution',
        'heading',
    ];
    
    protected $hidden = [
        'searchable',
    ];
    
    /**
     * return published, draft, pending status
     * @return [type] [description]
     */
    public static function parseStatus($resource)
    {
        if ($resource->published && $resource->published_at > now()) {
            return Pending::$key;
        }
        if (!$resource->published) {
            return Draft::$key;
        }
        
        return Published::$key;
    }
    
    protected static function booted()
    {
        static::saving(function ($post) {
            $post->content_fr = Post::defaultEditorJsIfNull($post->content_fr);
            $post->content_en = Post::defaultEditorJsIfNull($post->content_en);
            $post->content_fr_v2_top = Post::defaultEditorJsIfNull($post->content_fr_v2_top);
            $post->content_en_v2_top = Post::defaultEditorJsIfNull($post->content_en_v2_top);
            $post->content_fr_v2_bottom = Post::defaultEditorJsIfNull($post->content_fr_v2_bottom);
            $post->content_en_v2_bottom = Post::defaultEditorJsIfNull($post->content_en_v2_bottom);
            $post->credits_fr = Post::defaultEditorJsIfNull($post->credits_fr);
            $post->credits_en = Post::defaultEditorJsIfNull($post->credits_en);
            
            if ($post->type === Read::$key && is_null($post->time)) {
                if ($post->v2) {
                    $post->time = ContentParser::parseForTimeV2(
                        strip_tags($post->content_fr_v2_top).' '.strip_tags($post->content_fr_v2_bottom)
                    );
                } else {
                    $post->time = ContentParser::parseForTime($post->content_fr);
                }
            }
        });
        
        static::creating(function ($post) {
            $post = ContentParser::slugify($post);
        });
        static::created(function ($post) {
            $post->moveToStart();
            ResponseCache::clear();
        });
        static::updated(function ($post) {
            ResponseCache::clear();
        });
        static::deleted(function ($post) {
            ResponseCache::clear();
        });
        static::belongsToManyAttached(function ($relation, $parent, $ids, $attributes) {
            ResponseCache::clear();
        });
        static::belongsToManyDetached(function ($relation, $parent, $ids) {
            ResponseCache::clear();
        });
    }
    
    protected static function defaultEditorJsIfNull($field)
    {
        if (is_null($field) || empty($field)) {
            return json_encode(["time" => time(), 'blocks' => []]);
        }
        
        return $field;
    }
    
    /**
     * add query for sorting the post
     * @return static
     */
    public function buildSortQuery()
    {
        return static::query()->where('heading', $this->heading);
    }
    
    public function searchableOptions()
    {
        return [
            'column' => 'searchable',
            'external' => true,
            'maintain_index' => true,
            'rank' => [
                'fields' => [
                    'title' => 'A',
                    'titleen' => 'B',
                ],
                'weights' => [0.1, 0.2, 0.4, 1.0],
                'function' => 'ts_rank_cd',
                'normalization' => 32,
            ],
            'config' => 'simple',
        ];
    }
    
    public function toSearchableArray()
    {
        if (App::getLocale() === "fr") {
            return [
                'title' => $this->getTranslation('title', 'fr'),
                'author' => $this->user->fullname ?? null,
                'author2' => $this->author ?? null,
            ];
        } else {
            return [
                'titleen' => $this->getTranslation('title', 'en'),
                'author' => $this->user->fullname ?? null,
                'author2' => $this->author ?? null,
            ];
        }
    }
    
    public static function parseTagsForSearch($tags, $lang)
    {
        return $tags->map(function ($el) use ($lang) {
            return $el->getTranslation('name', $lang);
        })->implode(' ');
    }
    
    /**
     * the user relationship
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * the pictogram relationship
     * @return Pictogram
     */
    public function pictogram()
    {
        return $this->belongsTo(Pictogram::class);
    }
    
    /**
     * the tags relationships
     * @return Collection
     */
    public function tags()
    {
        return $this
            ->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id')
            ->withPivot('id')
            ->withTimestamps();
    }
    
    public function getSearchableTitleAttribute()
    {
        return StateHelper::byKey($this->category, self::$categoryStates).': '.$this->getTranslation('title', 'fr');
    }
    
    public function other_project_1()
    {
        return $this->morphTo(__FUNCTION__, 'other_project_1_type', 'other_project_1_id');
    }
    
    public function other_project_2()
    {
        return $this->morphTo(__FUNCTION__, 'other_project_2_type', 'other_project_2_id');
    }
    
    public function other_project_3()
    {
        return $this->morphTo(__FUNCTION__, 'other_project_3_type', 'other_project_3_id');
    }
    
    public function other_project_4()
    {
        return $this->morphTo(__FUNCTION__, 'other_project_4_type', 'other_project_4_id');
    }
    
    
}
