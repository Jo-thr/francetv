<?php

namespace App\Nova\Forms\Post;

use Eminiarts\Tabs\Tabs;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Techouse\IntlDateTime\IntlDateTime as DateTime;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Type;
use Illuminate\Http\Request;
use Infinety\Filemanager\FilemanagerField;
use Advoor\NovaEditorJs\NovaEditorJs;
use App\Models\Heading;
use App\Models\PostType;
use App\Models\States\Heading\AllPosts;
use App\Models\States\Heading\Podcast;
use NovaErrorField\Errors;
use App\Models\States\Heading\News;
use DigitalCreative\ConditionalContainer\ConditionalContainer;

use App\Models\States\Type\See;
use App\Models\States\Type\Test;
use App\Models\States\Type\Listen;

use Giuga\LaravelNovaFieldIframe\Iframe;

use App\Rules\ReadTime;


class ContributionPostForm
{
    public static function make(Request $request, string $heading)
    {
        return

              [

                  Errors::make(),

                  Boolean::make(__('field:published'), 'published')
                  ->default(true)->onlyOnForms(),


              (new Tabs('Tabs', [
                __('post:labelSingular') => [

                  Text::make(__('field:title'), 'title')
                  ->translatable(),

                  Textarea::make(__('field:excerpt'), 'excerpt')
                  ->translatable(),

                  FilemanagerField::make(__('field:featured'), 'featured')
                    ->displayAsImage()
                    ->hideFromIndex()
                    ->nullable(),

                  Text::make(__('field:featuredalt'), 'featuredalt')
                  ->translatable()
                  ->sortable(),

                  Text::make(__('field:slug'), 'slug')
                  ->readOnly(),

                  Hidden::make('category')->default('contribution'),

                  DateTime::make(__('field:pubDate'), 'published_at')
                                ->locale('fr')
                                ->withTimeShort()
                                ->sortable()
                                ->default(now()),
                  Hidden::make('category')->default('contribution'),

                  ConditionalContainer::make([
                    Iframe::make('Iframe', 'iframe')->onlyOnDetail(),
                    Textarea::make('Iframe', 'iframe')->onlyOnForms(),
                  ])
                  ->if("heading = podcasts"),

              ],
             __('field:categorization') => array_merge(self::getFieldsAbstract($heading), [

             ConditionalContainer::make([
                 Select::make(__('field:age'), 'age')->options([
                     'all' => 'Tous publics',
                     'adult' => '+16 ans',
                     'young' => 'Jeunesse',
                 ])->rules('required'),
                 Select::make('Flag', 'flag')->options([
                     'co-production' => 'Co-production',
                     'archive' => 'Archive',
                 ])->nullable(),
             ])
                 ->if("heading = recherche-narrative"),

              ConditionalContainer::make([
                Text::make('speakers')
                ->nullable()
                ->placeholder('Intervenants, séparés par des points virgule')
                ->hideFromIndex(),
              ])
              ->if("heading = podcasts"),

               BelongsTo::make(__('field:author'), 'user', \App\Nova\User::class)
               ->nullable()
               ->sortable()
               ->searchable(),

               Text::make(__('field:authorManual'), 'author')
               ->nullable()
               ->placeholder('Si ce champs est rempli, il surchargera le champs auteur ci-dessus')
               ->hideFromIndex(),

              Select::make(__('field:postType'), 'type')
              ->options(PostType::toArray())
              ->displayUsingLabels()
              ->nullable()
              ->default(null)
              ->hideFromIndex(),

            ConditionalContainer::make([
                Text::make('Temps de lecture (hh:mm:ss)', 'time')
                ->rules([new ReadTime()])
                ->onlyOnForms(),
              ])
              ->if("type === ".Listen::$key)
              ->if("type === ".See::$key)
              ->if("type === ".Test::$key),

              Text::make('Temps de lecture (hh:mm:ss)', 'time')
              ->rules('regex:/^(?:([01]?\d|2[0-3]):([0-5]?\d):)?([0-5]?\d)$/')
              ->onlyOnDetail(),

               BelongsToManyField::make('Tags', 'tags', \App\Nova\Tag::class)
               ->hideFromIndex()
               ->setMultiselectProps([
                   'closeOnSelect' => false,
               ])
               ->optionsLabel('name.fr'),

               BelongsTo::make(__('field:pictogram'), 'pictogram', \App\Nova\Pictogram::class)
               ->searchable()
               ->nullable()
               ->hideFromIndex(),
             ]),

              __('field:contentFr') => [


                NovaEditorJs::make('', 'content_fr')->stacked()->hideFromIndex(),

              ],

              __('field:contentEn') => [

                NovaEditorJs::make('', 'content_en')->stacked()->hideFromIndex(),

              ],
            ]))->withToolbar(),
        ];
    }

    private static function getFieldsAbstract(string $heading)
    {
        if ($heading === AllPosts::$key) {
            return [
          Select::make(__('field:heading'), 'heading')
          ->options(Heading::toArray())
          ->required()
          ->rules('required')
          ->default(News::$key)
          ->displayUsingLabels(),
        ];
        }
        return [
        Hidden::make('heading')->default(function ($request) use ($heading) {
            return $heading;
        }),
      ];
    }
}
