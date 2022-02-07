<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Techouse\IntlDateTime\IntlDateTime as DateTime;

class Contact extends Resource
{
    public static $globallySearchable = false;
    public static $perPageOptions = [10, 25, 50];

    public static $model = \App\Models\Contact::class;

    public static $title = 'created_at';

    public static $search = [ 'id' ];

    public function fields(Request $request)
    {
        return [

            DateTime::make("Date d'envoi", 'created_at')
            ->locale('fr')
            ->withTimeShort()
            ->sortable()
            ->default(now()),

            Text::make('Email')->sortable(),
            Text::make('Prénom', 'firstname')->sortable(),
            Text::make('Nom', 'lastname')->sortable(),
            Textarea::make('Message')->sortable()->alwaysShow(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
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
