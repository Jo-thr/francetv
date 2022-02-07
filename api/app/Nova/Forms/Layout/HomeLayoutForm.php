<?php

namespace App\Nova\Forms\Layout;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\MorphTo;
use Infinety\Filemanager\FilemanagerField;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\Boolean;
use Yna\NovaSwatches\Swatches;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\BelongsTO;
use Giuga\LaravelNovaFieldIframe\Iframe;

class HomeLayoutForm
{
    public static function make(Request $request)
    {
        return [
        Text::make(__('field:page'), 'label')
            ->sortable()
            ->readOnly(function ($request) {
                return !$request->user()->hasRole('superadmin');
            }),
          (new Tabs('Tabs', [

              __('layout:mainBlock') => [


              Text::make('Type')->sortable()->readOnly(),

              MorphTo::make(__('field:block1'), 'block1')->types([
                  \App\Nova\Article::class,
                  \App\Nova\MetaMedia::class,
                  \App\Nova\Test::class,
              ])
              ->searchable()
              ->hideFromIndex(),

              FilemanagerField::make(__('field:block1img'), 'block1img')
              ->hideFromIndex()
              ->displayAsImage(),

              Text::make(__('field:block1imgalt'), 'block1imgalt')
              ->hideFromIndex()
              ->translatable(),

              Text::make('Titre alternatif', 'block1title')
              ->sortable()
              ->nullable()
              ->translatable(),

          ],

          __('layout:secondBlocks') => [

              MorphTo::make(__('field:block2'), 'block2')->types([
                  \App\Nova\Article::class,
                  \App\Nova\MetaMedia::class,
                  \App\Nova\Test::class,
              ])
              ->searchable()
              ->nullable()
              ->hideFromIndex(),

              Text::make('Titre alternatif de la mise en avant 2', 'block2title')
              ->sortable()
              ->nullable()
              ->translatable(),

              MorphTo::make(__('field:block3'), 'block3')->types([
                  \App\Nova\Article::class,
                  \App\Nova\MetaMedia::class,
                  \App\Nova\Test::class,
              ])
              ->nullable()
              ->searchable()
              ->hideFromIndex(),

              Text::make('Titre alternatif de la mise en avant 3', 'block3title')
              ->sortable()
              ->nullable()
              ->translatable(),

          ],

          __('layout:parameters') => [

              Text::make(__('field:about'), 'description')
              ->translatable()
              ->hideFromIndex(),

              Boolean::make('Mode événementiel', 'event_mode')
              ->hideFromIndex(),

              Text::make("Titre de l'événement", 'event_title')
              ->translatable()
              ->hideFromIndex(),

              Iframe::make('Iframe', 'iframe')->onlyOnDetail(),
              Textarea::make('Iframe', 'iframe')->onlyOnForms(),

              Textarea::make('Iframe Feed Twitter', 'iframe_twitter')->onlyOnForms(),
              Iframe::make('Iframe Feed Twitter', 'iframe_twitter')->onlyOnDetail(),
          ],
      ])),
      ];
    }
}
