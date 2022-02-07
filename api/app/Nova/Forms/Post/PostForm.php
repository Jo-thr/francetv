<?php

namespace App\Nova\Forms\Post;

use Advoor\NovaEditorJs\NovaEditorJs;
use Benjacho\BelongsToManyField\BelongsToManyField;
use DigitalCreative\ConditionalContainer\ConditionalContainer;
use Eminiarts\Tabs\Tabs;
use Giuga\LaravelNovaFieldIframe\Iframe;
use Illuminate\Http\Request;
use Infinety\Filemanager\FilemanagerField;
use Inspheric\Fields\Indicator;
use Kraftbit\NovaTinymce5Editor\NovaTinymce5Editor;
use Monaye\SimpleLinkButton\SimpleLinkButton;
use NovaErrorField\Errors;
use Techouse\IntlDateTime\IntlDateTime as DateTime;
use Waynestate\Nova\CKEditor;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Type;

use App\Models\Heading;
use App\Models\Post;
use App\Models\PostType;
use App\Models\States\Heading\AllPosts;
use App\Models\States\Heading\News;
use App\Models\States\PublicationStatus\Draft;
use App\Models\States\PublicationStatus\Pending;
use App\Models\States\PublicationStatus\Published;
use App\Models\States\StateHelper;
use App\Nova\Article;
use App\Rules\SlugExists;

class PostForm
{
    public static function make(Request $request, string $heading)
    {
        return [

        Errors::make(),

        Boolean::make(__('field:published'), 'published')
        ->default(true)->onlyOnForms(),
        ConditionalContainer::make([
            Boolean::make('V2', 'v2'),
        ])->if("heading = recherche-narrative"),


        (new Tabs('Tabs', [
          __('post:labelSingular') => [

              Indicator::make('Statut', function ($value) {
                  return Post::parseStatus($value);
              })
              ->labels(StateHelper::stateToArray(Post::$publicationStates))
              ->colors([
                     Pending::$key => 'orange',
                     Published::$key => 'green',
                     Draft::$key => 'red',
              ])->sortable(),

              Text::make(__('field:category'), function ($resource) {
                  return StateHelper::byKey($resource->category, Post::$categoryStates);
              })->onlyOnIndex()
              ->sortable(),

              FilemanagerField::make(__('field:featured'), 'featured')
                ->displayAsImage()
                ->hideFromIndex()
                ->nullable(),

              Text::make(__('field:featuredalt'), 'featuredalt')
              ->translatable()
              ->hideFromIndex()
              ->sortable(),

              ConditionalContainer::make([
                  Text::make(__('field:videoFeatured'), 'video'),
                  Text::make("Vidéo mise en avant (4:3)", 'video_square'),
                  Text::make("Vidéo mise en avant (alt)", 'video_alt'),
              ])->if('heading = recherche-narrative'),

              Text::make(__('field:title'), 'title')
              ->translatable()
              ->sortable()
              ->rules(
                'required',
                'max:255',
                'min:5'
              ),


              Text::make(__('field:slug'), 'slug')
              ->translatable()
              ->hideFromIndex()
              ->readOnly(),

              DateTime::make(__('field:pubDate'), 'published_at')
              ->locale('fr')
              ->withTimeShort()
              ->sortable()
              ->rules('required')
              ->default(now()),

              Hidden::make('category')->default('default'),

              ConditionalContainer::make([
                Textarea::make(__('field:excerpt'), 'excerpt')->translatable(),
              ])->if("heading != recherche-narrative"),

              ConditionalContainer::make([
                  CKEditor::make(__('field:excerpt'), 'excerpt')->options([
                      'height' => 300,
                      'toolbar' => [
                          ['Link'],
                      ],
                  ])
                      ->translatable(),
              ])->if("heading = recherche-narrative"),

              ConditionalContainer::make([
                Iframe::make('Iframe', 'iframe')->onlyOnDetail(),
                Textarea::make('Iframe', 'iframe')->onlyOnForms(),
              ])
              ->if("heading = podcasts"),

              ConditionalContainer::make([
                  FilemanagerField::make('Dossier de presse', 'press')
                      ->hideFromIndex()
                      ->validateUpload('max:20000')
                      ->nullable(),
              ])->if("heading = recherche-narrative"),
          ],

          "Illustration de l'article" => [
              FilemanagerField::make("Image", 'featured_illustration')
                  ->displayAsImage()
                  ->hideFromIndex()
                  ->rules(['required']),

              Text::make("Video", 'video_illustration')
                  ->hideFromIndex(),
          ],

          __('field:categorization') => array_merge(self::getFieldsAbstract($heading), [

            ConditionalContainer::make([
              Text::make('speakers')
              ->nullable()
              ->placeholder('Intervenants, séparés par des points virgule')
              ->hideFromIndex(),
            ])
            ->if("heading = podcasts"),

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

            Text::make('Temps de lecture (hh:mm:ss)', 'time')
                ->onlyOnForms()
                ->rules(['nullable', 'regex:/^(?:([01]?\d|2[0-3]):([0-5]?\d):)?([0-5]?\d)$/']),

            BelongsToManyField::make('Tags', 'tags', \App\Nova\Tag::class)
            ->hideFromIndex()
            ->setMultiselectProps([
                'closeOnSelect' => false,
                'max' => 8
            ])
            ->optionsLabel('name.fr'),

            BelongsTo::make(__('field:pictogram'), 'pictogram', \App\Nova\Pictogram::class)
            ->searchable()
            ->nullable()
            ->hideFromIndex(),

          ]),

            'Autres projets' => [
                ConditionalContainer::make([
                    \Laravel\Nova\Fields\Heading::make('Section disponible uniquement pour les articles du topic StoryLab'),
                ])->if("heading != recherche-narrative"),

                Hidden::make('other_project_1_type')->default(function () {
                    return Post::class;
                }),
                Hidden::make('other_project_2_type')->default(function () {
                    return Post::class;
                }),
                Hidden::make('other_project_3_type')->default(function () {
                    return Post::class;
                }),
                Hidden::make('other_project_4_type')->default(function () {
                    return Post::class;
                }),
                ConditionalContainer::make([
                  BelongsTo::make('1er article', 'other_project_1', Article::class)
                      ->hideFromIndex()
                      ->searchable()
                      ->rules('required'),
                  BelongsTo::make('2eme article', 'other_project_2', Article::class)
                      ->hideFromIndex()
                      ->searchable()
                      ->rules('required'),
                  BelongsTo::make('3eme article', 'other_project_3', Article::class)
                      ->hideFromIndex()
                      ->searchable()
                      ->rules('required'),
                  BelongsTo::make('4eme article', 'other_project_4', Article::class)
                      ->hideFromIndex()
                      ->searchable()
                      ->rules('required'),
                ])->if("heading = recherche-narrative"),
          ],

          __('field:contentFr') => [

              ConditionalContainer::make([
                NovaEditorJs::make('', 'content_fr')
                    ->nullable()
                    ->stacked()
                    ->hideFromIndex(),
              ])->if("v2 = false"),

              ConditionalContainer::make([
                  NovaEditorJs::make('', 'content_fr_v2_top')
                      ->nullable()
                      ->stacked()
                      ->hideFromIndex(),
                  NovaEditorJs::make('', 'content_fr_v2_bottom')
                      ->nullable()
                      ->stacked()
                      ->hideFromIndex(),
              ])->if("v2 = true"),

          ],

          __('field:contentEn') => [

              ConditionalContainer::make([
                NovaEditorJs::make('', 'content_en')->stacked()->hideFromIndex(),
              ])->if("v2 = false"),

              ConditionalContainer::make([
                  NovaEditorJs::make('', 'content_en_v2_top')->stacked()->hideFromIndex(),
                  NovaEditorJs::make('', 'content_en_v2_bottom')->stacked()->hideFromIndex(),
              ])->if("v2 = true"),

          ],
            "Store" => [
                ConditionalContainer::make([
                    \Laravel\Nova\Fields\Heading::make('Store disponible uniquement pour les articles du topic StoryLab'),
                ])->if("heading != recherche-narrative"),

                ConditionalContainer::make([

                    \Laravel\Nova\Fields\Heading::make('Apple'),
                    Text::make('url', 'apple_url'),
                    Select::make( 'Etoiles' , 'apple_rating')->options([
                        '0' => 0,
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                        '5' => 5,
                    ]),

                    \Laravel\Nova\Fields\Heading::make('Google'),
                    Text::make('url', 'google_url'),
                    Select::make( 'Etoiles' , 'google_rating')->options([
                        '0' => 0,
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                        '5' => 5,
                    ]),

                    \Laravel\Nova\Fields\Heading::make('Oculus'),
                    Text::make('Url', 'oculus_url'),
                    Select::make( 'Etoiles' , 'oculus_rating')->options([
                        '0' => 0,
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                        '5' => 5,
                    ]),

                    \Laravel\Nova\Fields\Heading::make('Autre 1'),
                    Text::make('Nom', 'name_store_1'),
                    Text::make('Url', 'url_store_1'),
                    FilemanagerField::make("Logo", 'logo_store_1')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                    Select::make( 'Etoiles' , 'rating_store_1')->options([
                        '0' => 0,
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                        '5' => 5,
                    ]),


                    \Laravel\Nova\Fields\Heading::make('Autre 2'),
                    Text::make('Nom', 'name_store_2'),
                    Text::make('Url', 'url_store_2'),
                    FilemanagerField::make("Logo", 'logo_store_2')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                    Select::make( 'Etoiles' , 'rating_store_2')->options([
                        '0' => 0,
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                        '5' => 5,
                    ]),

                ])->if("heading = recherche-narrative"),

            ],
            "Galerie" => [
                ConditionalContainer::make([
                    \Laravel\Nova\Fields\Heading::make('Galerie disponible uniquement pour les articles du topic StoryLab'),
                ])->if("heading != recherche-narrative"),
                ConditionalContainer::make([
                    FilemanagerField::make("1ere image", 'carousel_1')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                    Text::make('Legende 1ere image', 'carousel_1_legend'),

                    FilemanagerField::make("2eme image", 'carousel_2')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                    Text::make('Legende 2eme image', 'carousel_2_legend'),

                    FilemanagerField::make("3eme image", 'carousel_3')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                    Text::make('Legende 3eme image', 'carousel_3_legend'),

                    FilemanagerField::make("4eme image", 'carousel_4')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                    Text::make('Legende 4eme image', 'carousel_4_legend'),

                    FilemanagerField::make("5eme image", 'carousel_5')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                    Text::make('Legende 5eme image', 'carousel_5_legend'),

                    FilemanagerField::make("6eme image", 'carousel_6')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                        Text::make('Legende 6eme image', 'carousel_6_legend'),

                    FilemanagerField::make("7eme image", 'carousel_7')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                        Text::make('Legende 7eme image', 'carousel_7_legend'),

                    FilemanagerField::make("8eme image", 'carousel_8')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                        Text::make('Legende 8eme image', 'carousel_8_legend'),

                    FilemanagerField::make("9eme image", 'carousel_9')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                        Text::make('Legende 9eme image', 'carousel_9_legend'),

                    FilemanagerField::make("10eme image", 'carousel_10')
                        ->filterBy('images')
                        ->displayAsImage()
                        ->hideFromIndex()
                        ->nullable(),
                        Text::make('Legende 10eme image', 'carousel_10_legend'),
                ])->if("heading = recherche-narrative"),
            ],
            'Crédits' => [
                ConditionalContainer::make([
                    \Laravel\Nova\Fields\Heading::make('Crédits disponible uniquement pour les articles du topic StoryLab v2'),
                ])->if("heading != recherche-narrative OR v2 = false"),
                ConditionalContainer::make([
                    NovaEditorJs::make('Crédits FR', 'credits_fr')->stacked()->hideFromIndex(),
                    NovaEditorJs::make('Crédits EN', 'credits_en')->stacked()->hideFromIndex(),
                ])->if("heading = recherche-narrative AND v2 = true"),
            ],
      ]))->withToolbar()
  ];
    }

    private static function getFieldsAbstract(string $heading)
    {
        if ($heading === AllPosts::$key) {
            return [
          Select::make(__('field:heading'), 'heading')
          ->options(Heading::toArray())
          ->sortable()
          ->required()
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
