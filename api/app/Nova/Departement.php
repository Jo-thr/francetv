<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Departement extends Resource
{
    public static $model = \App\Models\Departement::class;
    public static $title = 'name';
    public static $search = [ 'name' ];

    public static $globallySearchable = false;

    public function fields(Request $request)
    {
        return [

            Text::make(__('field:name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->sortable(),
            HasMany::make(__('field:users'), 'users', \App\Nova\User::class),
        ];
    }

    public static function group()
    {
        return __('group:advanced');
    }

    public static function label()
    {
        return __('departement:label');
    }

    public static function singularLabel()
    {
        return __('departement:labelSingular');
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
