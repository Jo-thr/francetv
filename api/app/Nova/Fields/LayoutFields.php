<?php

namespace App\Nova\Fields;

use App\Models\Layout;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\BelongsTo;
use Infinety\Filemanager\FilemanagerField;

class LayoutFields
{
    public static function getUpdateFields($layout)
    {
        return [
        Text::make('Page/Rubrique', 'label')->sortable()->readOnly(),

        MorphTo::make('Featured')->types([
            \App\Nova\Posts::class,
            \App\Nova\MetaMedia::class,
        ])->searchable(),

        FilemanagerField::make('featuredimg')->hideFromIndex()->displayAsImage(),

        Text::make('featuredimgalt')->hideFromIndex()->translatable(),


        MorphTo::make('Block2')->types([
            \App\Nova\Posts::class,
            \App\Nova\MetaMedia::class,
        ])->searchable(),

        MorphTo::make('Block3')->types([
            \App\Nova\Posts::class,
            \App\Nova\MetaMedia::class,
        ])->searchable(),

        MorphTo::make('Block4')->types([
            \App\Nova\Posts::class,
            \App\Nova\MetaMedia::class,
        ])->searchable(),
    ];
    }

    public static function getFields()
    {
        return [
        Text::make('Page/Rubrique', 'label')->sortable()->readOnly(),

        MorphTo::make('Featured')->types([
            \App\Nova\Posts::class,
            \App\Nova\MetaMedia::class,
        ])->searchable(),

        FilemanagerField::make('featuredimg')->hideFromIndex()->displayAsImage(),

        Text::make('featuredimgalt')->hideFromIndex()->translatable(),

        MorphTo::make('Block2')->types([
            \App\Nova\Posts::class,
            \App\Nova\MetaMedia::class,
        ])->searchable(),

        MorphTo::make('Block3')->types([
            \App\Nova\Posts::class,
            \App\Nova\MetaMedia::class,
        ])->searchable(),

        MorphTo::make('Block4')->types([
            \App\Nova\Posts::class,
            \App\Nova\MetaMedia::class,
        ])->searchable(),
    ];
    }

    public static function create(): array
    {
        return [
        Text::make('Page/Rubrique', 'label')->sortable()->readOnly(),
    ];
    }

    public static function detail(Layout $layout): array
    {
        return [
        Text::make('Page/Rubrique', 'label')->sortable()->readOnly(),

        Text::make('Article mise en avant 1', function ($item) {
            return $item->featured->title;
        }),

        Text::make('description')->translatable(),


        FilemanagerField::make('featuredimg')->hideFromIndex()->displayAsImage(),

        Text::make('featuredimgalt')->hideFromIndex()->translatable(),

        Text::make('Article mise en avant 2', function ($item) {
            return $item->block2->title;
        }),

        Text::make('Article mise en avant 3', function ($item) {
            return $item->block3->title;
        }),

    ];
    }
}
