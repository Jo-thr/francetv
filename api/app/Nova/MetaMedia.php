<?php

namespace App\Nova;

use App\Nova\Actions\FetchMetaMedia;
use App\Nova\Actions\RebuildMetaMediaDB;
use Chaseconey\ExternalImage\ExternalImage;
use Illuminate\Http\Request;
use Techouse\IntlDateTime\IntlDateTime as DateTime;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Type;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class MetaMedia extends Resource
{
    use HasSortableRows;

    public static $model = \App\Models\MetaMedia::class;
    public static $priority = 1;
    public static $title = 'title';
    public static $search = [
        'title'
    ];

    public function fields(Request $request)
    {
        return [
            Text::make(__('field:title'), 'title'),
            Text::make(__('field:url'), 'url')->hideFromIndex(),
            ExternalImage::make(__('field:featured'), 'image')->width(650)->hideFromIndex(),
            DateTime::make(__('field:pubDate'), 'published_at')
                    ->sortable()
                    ->withTime()
                    ->locale('fr'),
        ];
    }

    public static $defaultSort = [
        'sort_order' => 'asc',
        'published_at' => 'desc'
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (static::$defaultSort && empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            foreach (static::$defaultSort as $field => $order) {
                $query->orderBy($field, $order);
            }
        }
        return $query;
    }

    public function actions(Request $request)
    {
        return [
            RebuildMetaMediaDB::make()
                ->onlyOnIndexToolbar()
                ->canSee(function ($request) {
                    return \Auth::user()->hasRole('superadmin');
                })
                ->canRun(function ($request) {
                    return \Auth::user()->hasRole('superadmin');
                })
                ->confirmText(__('action:confirmRebuildMetaMedia'))
                ->confirmButtonText(__('action:proceed')),
            FetchMetaMedia::make()
                ->onlyOnIndexToolbar()
                ->confirmText(__('action:confirmFetchMetaMedia'))
                ->confirmButtonText(__('action:proceed'))
                ->canRun(function ($request) {
                    return \Auth::user()->hasRole(['superadmin', 'editor', 'admin']);
                }),
        ];
    }

    public static function group()
    {
        return __('group:publication');
    }

    public static function label()
    {
        return __('metamedia:label');
    }

    public static function singularLabel()
    {
        return __('metamedia:label');
    }
}
