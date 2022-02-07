<?php

namespace App\Nova\Forms\Layout;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Hidden;
use Infinety\Filemanager\FilemanagerField;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\Boolean;
use Yna\NovaSwatches\Swatches;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\BelongsTo;

use App\Models\States\LayoutType\Main;
use App\Models\States\LayoutType\Narrative;
use App\Models\States\LayoutType\Tests;
use App\Models\States\LayoutType\Home;
use App\Models\States\LayoutType\MetaMedia;

use Outhebox\NovaHiddenField\HiddenField;

class IndexForm
{
    public static function make($type = null)
    {
        switch ($type) {
          case Tests::$key:
              return array_merge(self::main(), self::testFormStruct());
          case MetaMedia::$key:
              return array_merge(self::main(), self::metaMediaFormStruct());
          case Narrative::$key:
              return NarrativeLayoutForm::make();
          case Home::$key:
              return array_merge(self::main(), self::homeFormStruct());
          default:
              return array_merge(self::main(), self::mainFormStruct());
      }
    }

    private static function main()
    {
        return [

          Text::make(__('field:page'), 'label')
              ->sortable()
              ->readOnly(function ($request) {
                  return !$request->user()->hasRole('superadmin');
              }),

          FilemanagerField::make(__('field:block1img'), 'block1img')->hideFromIndex()->displayAsImage(),

          Text::make(__('field:block1imgalt'), 'block1imgalt')->hideFromIndex()->translatable(),

          Text::make(__('field:descriptionHeading'), 'description')
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
          ])
          ->hideFromIndex(),

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
          ])
          ->hideFromIndex(),

          Boolean::make(__('field:fontblack'), 'font_black')
          ->hideFromIndex(),
      ];
    }

    private static function testFormStruct()
    {
        return [
        BelongsTo::make(__('field:block1'), 'block1', '\App\Nova\Test')->hideFromIndex(),
        Hidden::make('block1_type')->default(function () {
            return $this->block1_type;
        }),

        BelongsTo::make(__('field:block2'), 'block2', '\App\Nova\Article')->hideFromIndex(),
        Hidden::make('block2_type')->default(function () {
            return $this->block2_type;
        }),

        BelongsTo::make(__('field:block3'), 'block3', '\App\Nova\Test')->hideFromIndex(),
        Hidden::make('block3_type')->default(function () {
            return $this->block3_type;
        }),
      ];
    }

    private static function mainFormStruct()
    {
        return [
        BelongsTo::make(__('field:block1'), 'block1', '\App\Nova\Article')->hideFromIndex(),
        Hidden::make('block1_type')->default(function () {
            return $this->block1_type;
        }),

        BelongsTo::make(__('field:block2'), 'block2', '\App\Nova\Article')->hideFromIndex(),
        Hidden::make('block2_type')->default(function () {
            return $this->block2_type;
        }),

        BelongsTo::make(__('field:block3'), 'block3', '\App\Nova\Article')->hideFromIndex(),
        Hidden::make('block3_type')->default(function () {
            return $this->block3_type;
        }),
      ];
    }

    private static function narrativeFormStruct()
    {
        return [
        BelongsTo::make(__('field:block1'), 'block1', '\App\Nova\Article')->hideFromIndex(),
        Hidden::make('block1_type')->default(function () {
            return $this->block1_type;
        }),

        BelongsTo::make(__('field:block2'), 'block2', '\App\Nova\Article')->hideFromIndex(),
        Hidden::make('block2_type')->default(function () {
            return $this->block2_type;
        }),

        BelongsTo::make(__('field:block3'), 'block3', '\App\Nova\Article')->hideFromIndex(),
        Hidden::make('block3_type')->default(function () {
            return $this->block3_type;
        }),

        BelongsTo::make(__('field:block4'), 'block4', '\App\Nova\Article')->hideFromIndex(),
        Hidden::make('block4_type')->default(function () {
            return $this->block4_type;
        }),
      ];
    }

    private static function metaMediaFormStruct()
    {
        return [
        BelongsTo::make(__('field:block1'), 'block1', '\App\Nova\MetaMedia')
        ->hideFromIndex(),
        Hidden::make('block1_type')->default(function () {
            return $this->block1_type;
        }),

        BelongsTo::make(__('field:block2'), 'block2', '\App\Nova\MetaMedia')
        ->hideFromIndex(),
        Hidden::make('block2_type')->default(function () {
            return $this->block2_type;
        }),

        BelongsTo::make(__('field:block3'), 'block3', '\App\Nova\MetaMedia')
        ->hideFromIndex(),
        Hidden::make('block3_type')->default(function () {
            return $this->block3_type;
        }),

      ];
    }

    private static function homeFormStruct()
    {
        return [
          MorphTo::make(__('field:block1'), 'block1')->types([
              \App\Nova\MetaMedia::class,
              \App\Nova\Article::class,
              \App\Nova\Test::class,
          ])
          ->searchable()
          ->hideFromIndex(),

          MorphTo::make(__('field:block2'), 'block2')->types([
              \App\Nova\MetaMedia::class,
              \App\Nova\Article::class,
              \App\Nova\Test::class,
          ])
          ->searchable()
          ->hideFromIndex(),

          MorphTo::make(__('field:block3'), 'block3')->types([
              \App\Nova\MetaMedia::class,
              \App\Nova\Article::class,
              \App\Nova\Test::class,
          ])
          ->searchable()
          ->hideFromIndex(),

          MorphTo::make(__('field:block4'), 'block4')->types([
              \App\Nova\MetaMedia::class,
              \App\Nova\Article::class,
              \App\Nova\Test::class,
          ])
          ->searchable()
          ->hideFromIndex(),
      ];
    }
}
