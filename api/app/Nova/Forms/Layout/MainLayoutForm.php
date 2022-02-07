<?php

namespace App\Nova\Forms\Layout;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphTo;
use Infinety\Filemanager\FilemanagerField;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Hidden;
use Yna\NovaSwatches\Swatches;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Textarea;

class MainLayoutForm
{
    public static function make(Request $request)
    {
        return [
          Text::make(__('field:page'), 'label')
              ->sortable()
              ->readOnly(function ($request) {
                  return !$request->user()->hasRole('superadmin');
              }),

          (new Tabs('Main', [
          __('layout:mainBlock') => [


          BelongsTo::make(__('field:featuredPost'), 'block1', '\App\Nova\Article')
          ->hideFromIndex()
          ->searchable(),

          Hidden::make('block1_type')->default(function () {
              return $this->block3_type;
          }),

          FilemanagerField::make(__('field:block1img'), 'block1img')->hideFromIndex()->displayAsImage(),

          Text::make('Titre alternatif', 'block1title')
          ->sortable()
          ->nullable()
          ->translatable(),

          Text::make(__('field:block1imgalt'), 'block1imgalt')->hideFromIndex()->translatable(),
          ],
          __('layout:secondBlocks') => [

            BelongsTo::make(__('field:block2'), 'block2', '\App\Nova\Article')
            ->hideFromIndex()
            ->nullable()
            ->searchable(),

            Hidden::make('block2_type')->default(function () {
                return $this->block2_type;
            }),

            Text::make('Titre alternatif de la mise en avant 2', 'block2title')
            ->sortable()
            ->nullable()
            ->translatable(),

            BelongsTo::make(__('field:block3'), 'block3', '\App\Nova\Article')
            ->hideFromIndex()
            ->nullable()
            ->searchable(),

            Hidden::make('block3_type')->default(function () {
                return $this->block3_type;
            }),

            Text::make('Titre alternatif de la mise en avant 3', 'block3title')
            ->sortable()
            ->nullable()
            ->translatable(),


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
