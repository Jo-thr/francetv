<?php

namespace App\Nova;

use App\Nova\Actions\DeleteCategory;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Tag extends Resource
{
    public static $model = \App\Models\Tag::class;
    public static $title = 'name';
    public static $globallySearchable = false;
    public static $search = [
        'name'
    ];

    public function fields(Request $request)
    {
        return [

            Text::make(__('field:name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->translatable()
                ->sortable(),

            Text::make(__('field:slug'), 'slug')
                ->rules('required', 'max:255')
                ->translatable(),

        ];
    }

    public static function group()
    {
        return __('group:advanced');
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
