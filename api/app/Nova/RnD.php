<?php

namespace App\Nova;

use App\Nova\Meta\PostResourceAbstract;
use App\Models\States\Heading\RnD as Heading;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use App\Helpers\NovaToolbox;

class RnD extends PostResourceAbstract
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
        return __('rnd:label');
    }

    public static function singularLabel()
    {
        $params = NovaToolbox::query(request());

        if (isset($params['external']) && $params['external']) {
            return __('rnd:labelSingular').' Externe';
        } elseif (isset($params['contribution']) && $params['contribution']) {
            return __('rnd:labelSingular').' Contribution';
        }
        return __('rnd:labelSingular');
    }
}
