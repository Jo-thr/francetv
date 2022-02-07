<?php

namespace App\Nova\Forms\Layout;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;
use Infinety\Filemanager\FilemanagerField;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\Boolean;
use Yna\NovaSwatches\Swatches;

class TestsLayoutForm
{
    public static function make(Request $request)
    {
        return [
          Text::make('Page/Rubrique', 'label')
              ->sortable()
              ->readOnly(function ($request) {
                  return !$request->user()->hasRole('superadmin');
              }),

          (new Tabs('Tabs', [
          __('layout:mainBlock') => [


          FilemanagerField::make(__('field:block1img'), 'block1img')->hideFromIndex()->displayAsImage(),

          Text::make(__('field:block1imgalt'), 'block1imgalt')->hideFromIndex()->translatable(),

          BelongsTo::make(__('field:featuredTest'), 'block1', '\App\Nova\Test')
          ->searchable()
          ->nullable(),

          Hidden::make('block1_type')->default('App\Models\Test'),

          Text::make('Titre alternatif', 'block1title')
          ->sortable()
          ->nullable()
          ->translatable(),

          ],
          __('layout:secondBlocks') => [

            Text::make(__('field:contributionTitle'), 'block2title')
            ->sortable()
            ->translatable(),

            BelongsTo::make(__('field:contribution'), 'block2', '\App\Nova\Article')
            ->hideFromIndex()
            ->searchable()
            ->nullable(),
            Hidden::make('block2_type')->default(\App\Models\Post::class)->hideFromIndex(),

            Text::make('Titre alternatif dernière chance', 'block3title')
            ->sortable()
            ->nullable()
            ->translatable(),

            BelongsTo::make(__('field:lastChance'), 'block3', '\App\Nova\Test')
            ->hideFromIndex()
            ->searchable()
            ->nullable(),
            Hidden::make('block3_type')->default(\App\Models\Test::class)->hideFromIndex(),

            FilemanagerField::make(__('field:block3img'), 'block3img')->hideFromIndex()->displayAsImage(),

            Text::make(__('field:block3imgalt'), 'block3imgalt')->hideFromIndex()->translatable(),
          ],

          __('layout:parameters') => [
              Textarea::make(__('field:descriptionHeading'), 'description')
              ->translatable()
              ->hideFromIndex(),

              Text::make(__('field:layoutTitle'), 'title')
              ->translatable()
              ->hideFromIndex(),

              Swatches::make(__('field:background'), 'background')
              ->colors([
                  "#0023FF",
                  "#90CEFF",
                  "#FF778B",
                  "#7DFFCE",
                  "#FCFC00",
                  "#F3F5F8",
                  "#000000"
              ])
              ->withProps([
                  'inline' => true,
                  'show-fallback' => false,
                  'fallback-type' => 'input',
                  'popover-to' => 'left',
              ]),

              Swatches::make(__('field:underline'), 'underline')
              ->colors([
                  "#0023FF",
                  "#90CEFF",
                  "#FF778B",
                  "#7DFFCE",
                  "#FCFC00",
                  "#F3F5F8",
                  "#000000"
              ])
              ->withProps([
                  'inline' => true,
                  'show-fallback' => false,
                  'fallback-type' => 'input',
                  'popover-to' => 'left',
              ]),

              Boolean::make(__('field:fontblack'), 'font_black'),
          ],
      ])),
      ];
    }
}
