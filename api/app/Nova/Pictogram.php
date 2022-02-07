<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\Text;
use Infinety\Filemanager\FilemanagerField;

class Pictogram extends Resource
{
    public static $model = \App\Models\Pictogram::class;
    public static $title = 'title';
    public static $search = [
        'title'
    ];

    public static function group()
    {
        return __('group:publication');
    }

    public function fields(Request $request)
    {
        return [
            Text::make(__('field:title'), 'title'),
            FilemanagerField::make(__('field:image'), 'image')->displayAsImage(),
        ];
    }

    public static $defaultSort = 'created_at';

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (static::$defaultSort && empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            return $query->orderBy(static::$defaultSort, 'DESC');
        }
        return $query;
    }
}
