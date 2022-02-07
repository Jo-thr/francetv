<?php

namespace App\Nova;

use App\Nova\Meta\PostResourceAbstract;
use App\Models\States\Heading\Podcast as Heading;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use App\Helpers\NovaToolbox;

class Podcast extends PostResourceAbstract
{
    use HasSortableRows;

    public static $model = \App\Models\Post::class;
    public static $priority = 1;
    public static $title = 'title';

    public static function heading()
    {
        return Heading::$key;
    }

    public static $search = [ 'title' ];

    public static function label()
    {
        return __('podcast:label');
    }

    public static function singularLabel()
    {
        $params = NovaToolbox::query(request());

        if (isset($params['external']) && $params['external']) {
            return __('podcast:labelSingular').' Externe';
        } elseif (isset($params['contribution']) && $params['contribution']) {
            return __('podcast:labelSingular').' Contribution';
        }
        return __('podcast:labelSingular');
    }
}
