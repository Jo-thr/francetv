<?php

namespace App\Nova;

use App\Nova\Meta\PostResourceAbstract;
use App\Models\States\Heading\NarrativeResearch as Heading;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use App\Helpers\NovaToolbox;

class NarrativeResearch extends PostResourceAbstract
{
    use HasSortableRows;

    public static $model = \App\Models\Post::class;

    public static $priority = 1;

    public static $title = 'title';

    public static $search = [
        'id', 'title'
    ];

    public static function heading()
    {
        return Heading::$key;
    }

    public static function label()
    {
        return __('narrative:label');
    }

    public static function singularLabel()
    {
        $params = NovaToolbox::query(request());

        if (isset($params['external']) && $params['external']) {
            return __('narrative:labelSingular').' Externe';
        } elseif (isset($params['contribution']) && $params['contribution']) {
            return __('narrative:labelSingular').' Contribution';
        }
        return __('narrative:labelSingular');
    }
}
