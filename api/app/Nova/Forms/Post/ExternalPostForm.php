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
use Inspheric\Fields\Url;
use Whitecube\NovaFlexibleContent\Flexible;

use App\Models\Heading;
use App\Models\PostType;
use App\Models\States\Heading\AllPosts;
use App\Models\States\Heading\Podcast;
use NovaErrorField\Errors;
use App\Models\States\Heading\News;
use Giuga\LaravelNovaFieldIframe\Iframe;

use App\Models\States\Type\See;
use App\Models\States\Type\Test;
use App\Models\States\Type\Listen;

use DigitalCreative\ConditionalContainer\ConditionalContainer;

use App\Rules\ReadTime;

class ExternalPostForm
{
    public static function make(Request $request, string $heading)
    {
        return  [

            Errors::make(),

            Boolean::make(__('field:published'), 'published')
            ->default(true)
            ->onlyOnForms(),

            (new Tabs('Créer un article externe', [

              __('post:labelSingular') => array_merge([

            Text::make(__('field:title'), 'title')
                ->translatable(),

            Url::make(__('field:url'), 'url')
            ->rules('required', function($attribute, $value, $fail) {
                if (!filter_var($value, FILTER_VALIDATE_URL)) {
                    return $fail('Le champ Url doit être un url valide.');
                }
            }),

            FilemanagerField::make(__('field:featured'), 'featured')
              ->displayAsImage()
              ->hideFromIndex()
              ->nullable(),

            Text::make(__('field:featuredalt'), 'featuredalt')
            ->translatable()
            ->sortable(),

            Textarea::make(__('field:excerpt'), 'excerpt')
            ->translatable(),

            Hidden::make('category')->default('external'),

            ], self::podcastIframe($heading)),
            __('field:categorization') => array_merge(
                self::podcastField($heading),
                self::getFieldsAbstract($heading),
                [

              Select::make(__('field:postType'), 'type')
              ->options(PostType::toArray())
              ->displayUsingLabels()
              ->nullable()
              ->default(null)
              ->hideFromIndex(),

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

            DateTime::make(__('field:pubDate'), 'published_at')
                          ->locale('fr')
                          ->withTimeShort()
                          ->sortable()
                          ->default(now())
                          ->required(),

            Hidden::make('category')->default('external'),


            BelongsToManyField::make('Tags', 'tags', \App\Nova\Tag::class)
            ->setMultiselectProps([
                'closeOnSelect' => false,
            ])
            ->optionsLabel('name.fr'),
            ]
            ),
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

    private static function podcastField(string $heading)
    {
        if ($heading === Podcast::$key) {
            return [
          Text::make('speakers')
          ->nullable()
          ->placeholder('Intervenants, séparés par des points virgule')
          ->hideFromIndex(),
        ];
        }

        return [];
    }

    private static function podcastIframe(string $heading)
    {
        if ($heading === Podcast::$key) {
            return [
            Iframe::make('Iframe', 'iframe')->onlyOnDetail(),
            Textarea::make('Iframe', 'iframe')->onlyOnForms(),
        ];
        }

        return [];
    }
}
