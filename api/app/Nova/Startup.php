<?php

namespace App\Nova;

use App\Nova\Meta\PostResourceAbstract;
use App\Models\States\Heading\Startup as Heading;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use App\Helpers\NovaToolbox;

class Startup extends PostResourceAbstract
{
    use HasSortableRows;

    public static $model = \App\Models\Post::class;
    public static $priority = 4;

    public static $title = 'title';

    public static $search = [
        'id', 'title'
    ];

    public static function heading()
    {
        return Heading::$key;
    }

    public static function singularLabel()
    {
        $params = NovaToolbox::query(request());

        if (isset($params['external']) && $params['external']) {
            return 'Startup Externe';
        } elseif (isset($params['contribution']) && $params['contribution']) {
            return 'Startup Contribution';
        }
        return 'Startup';
    }
}
