<?php

namespace App\Nova;

use App\Nova\Meta\PostResourceAbstract;

use Laravel\Nova\Http\Requests\NovaRequest;

use App\Models\States\Heading\AllPosts;
use App\Models\Post;
use App\Helpers\NovaToolbox;

class Article extends PostResourceAbstract
{
    public static $model = Post::class;
    public static $priority = 0;

    public static $title = 'searchable_title';
    public static $globallySearchable = true;
    public static $defaultSort = 'created_at';
    public static $search = [
        'title->fr', 'title->en',
    ];

    public static function scoutQuery(NovaRequest $request, $query)
    {
        if ($query->model instanceof Post) {
            $post = Post::find($request->resourceId);

            if (!empty($post)) {
                $query->where('heading', $post->heading);
            }
        }
        
        $query->query = implode(' <-> ',explode(' ', $query->query));
        return $query;
    }

    public static function heading()
    {
        return AllPosts::$key;
    }

    public static function group()
    {
        return __('group:publication');
    }

    public static function label()
    {
        return __('post:label');
    }

    public static function singularLabel()
    {
        $params = NovaToolbox::query(request());

        if (isset($params['external']) && $params['external']) {
            return 'article externe';
        } elseif (isset($params['contribution']) && $params['contribution']) {
            return 'appel à contribution';
        }
        return __('post:labelSingular');
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (static::$defaultSort && empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            return $query->orderBy(static::$defaultSort, 'DESC');
        }
        return $query;
    }
}
