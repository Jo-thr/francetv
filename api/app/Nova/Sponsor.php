<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\Text;
use Infinety\Filemanager\FilemanagerField;

class Sponsor extends Resource
{
    public static $model = \App\Models\Sponsor::class;
    public static $title = 'name';
    public static $search = [
        'name',
    ];

    public static function group()
    {
        return __('group:publication');
    }

    public function fields(Request $request)
    {
        return [
            Text::make(__('field:name'), 'name'),
            FilemanagerField::make(__('field:image'), 'logo')->displayAsImage(),
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
