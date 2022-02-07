<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    public static $model = \App\Models\User::class;
    public static $title = 'fullname';
    public static $search = ['firstname', 'lastname', 'email'];
    public static $globallySearchable = false;
    public static $perPageOptions = [10, 25, 50];

    public function fields(Request $request)
    {
        return [

            Gravatar::make()->maxWidth(50),

            Text::make(__('field:firstname'), 'firstname')
                ->sortable()
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make(__('field:lastname'), 'lastname')
                ->sortable()
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make(__('field:email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make(__('field:password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            MorphToMany::make('Roles', 'roles', \Vyuldashev\NovaPermission\Role::class),
            BelongsTo::make(__('field:departement'), 'departement', 'App\Nova\Departement'),
        ];
    }

    public static function group()
    {
        return __('group:advanced');
    }

    public static function label()
    {
        return __('user:label');
    }

    public static function singularLabel()
    {
        return __('user:labelSingular');
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
