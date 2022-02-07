<?php

namespace App\Nova;

use App\Nova\Meta\PostResourceAbstract;
use App\Models\States\Heading\Tutorial as Header;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use App\Helpers\NovaToolbox;

class Tutorial extends PostResourceAbstract
{
    use HasSortableRows;

    public static $model = \App\Models\Post::class;

    public static $priority = 1;

    public static $title = 'title';

    public static function heading()
    {
        return Header::$key;
    }
    public static $search = [
        'id', 'title'
    ];
    /**
     * @return string
     */
    public static function label()
    {
        return __('tutorial:label');
    }

    public static function singularLabel()
    {
        $params = NovaToolbox::query(request());

        if (isset($params['external']) && $params['external']) {
            return __('tutorial:labelSingular').' Externe';
        } elseif (isset($params['contribution']) && $params['contribution']) {
            return __('tutorial:labelSingular').' Contribution';
        }
        return __('tutorial:labelSingular');
    }
}
