<?php

namespace App\Nova;

use App\Nova\Meta\PostResourceAbstract;
use App\Models\States\Heading\Transformation as Heading;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use App\Helpers\NovaToolbox;

class Transformation extends PostResourceAbstract
{
    use HasSortableRows;

    public static $model = \App\Models\Post::class;

    public static $priority = 1;

    public static $title = 'title';

    public static function heading()
    {
        return Heading::$key;
    }

    public static $search = [
        'id', 'title'
    ];

    public static function singularLabel()
    {
        $params = NovaToolbox::query(request());

        if (isset($params['external']) && $params['external']) {
            return 'Transformation Externe';
        } elseif (isset($params['contribution']) && $params['contribution']) {
            return 'Transformation Contribution';
        }
        return 'Transformation';
    }
}
