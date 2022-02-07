<?php

namespace App\Nova;

use Illuminate\Http\Request;

use Techouse\IntlDateTime\IntlDateTime as DateTime;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Infinety\Filemanager\FilemanagerField;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Inspheric\Fields\Indicator;
use Eminiarts\Tabs\Tabs;

use Illuminate\Support\Facades\Validator;
use Laravel\Nova\Http\Requests\NovaRequest;

use App\Models\States\Test\Finished;
use App\Models\States\Test\OnPause;
use App\Models\States\Test\Open;
use App\Models\States\Test\Soon;

use Eminiarts\Tabs\TabsOnEdit;
use App\Models\States\StateHelper;
use App\Nova\Flexible\Layouts\ParagraphLayout;

use Advoor\NovaEditorJs\NovaEditorJs;
use Giuga\LaravelNovaFieldIframe\Iframe;
use NovaErrorField\Errors;

class Test extends Resource
{
    use TabsOnEdit;

    public static $model = \App\Models\Test::class;
    public static $priority = 1;
    public static $title = 'title';
    public static $search = [
        'title'
    ];

    public function fields(Request $request)
    {
        return [

            Errors::make(),

            Boolean::make(__('field:publishedTest'), 'paused')
            ->default(false)->onlyOnForms(),

            (new Tabs('', [
            'Test' => [

            Text::make(__('field:title'), 'title')
            ->translatable()
            ->sortable()
            ->rules('required', 'max:255', 'min:5'),

            Text::make(__('field:slug'), 'slug')
            ->translatable()
            ->hideFromIndex()
            ->hideWhenCreating()
            ->readOnly(),

            FilemanagerField::make(__('field:featured'), 'featured')
              ->displayAsImage()
              ->hideFromIndex()
              ->nullable(),

            Text::make(__('field:featuredalt'), 'featuredalt')
            ->translatable()
              ->hideFromIndex()
            ->sortable(),


            DateTime::make(__('field:start'), 'start_at')
            ->locale('fr')
            ->minDate(now())
            ->withTimeShort()
            ->sortable()
            ->required(),

            DateTime::make(__('field:end'), 'end_at')
            ->locale('fr')
            ->minDate(now())
            ->withTimeShort()
            ->sortable()
            ->required(),

            Number::make(__('field:share'), 'share')
            ->readOnly()
            ->sortable()
            ->hideWhenCreating()
            ->hideWhenUpdating(),

            Indicator::make(__('field:status'), function ($value) {
                return \App\Models\Test::parseStatus($value);
            })
            ->labels(StateHelper::stateToArray(\App\Models\Test::$states))
            ->colors([
                   Soon::$key => 'blue',
                   OnPause::$key => 'orange',
                   Open::$key => 'green',
                   Finished::$key => 'red',
               ]),
            Textarea::make(__('field:excerpt'), 'excerpt')->translatable(),

            ],
            'Iframe' => [

                Iframe::make('Iframe (français)', 'iframe_test')->onlyOnDetail(),
                Textarea::make('Iframe (français)', 'iframe_test')->onlyOnForms(),

                Iframe::make('Iframe (anglais)', 'iframe_en')->onlyOnDetail(),
                Textarea::make('Iframe (anglais)', 'iframe_en')->onlyOnForms(),

            ],
            __('field:contentFr') => [


              NovaEditorJs::make('', 'content_fr')->stacked()->hideFromIndex(),

            ],

            __('field:contentEn') => [

              NovaEditorJs::make('', 'content_en')->stacked()->hideFromIndex(),

            ],

            __('field:categorization') => [
                BelongsToManyField::make('Tags', 'tags', \App\Nova\Tag::class)
                ->optionsLabel('name.fr')
                ->setMultiselectProps([
                    'closeOnSelect' => false,
                ])
                ->hideFromIndex(),

                BelongsTo::make(__('field:sponsor'), 'sponsor', \App\Nova\Sponsor::class)
                ->searchable()
                ->nullable()
                ->hideFromIndex(),
            ],

            __('field:usabilla') => [

              Text::make('Nom du déclencheur desktop (français)', 'desktop_trigger_fr')->hideFromIndex(),
              Text::make('Nom du déclencheur desktop (anglais)', 'desktop_trigger_en')->hideFromIndex(),
              Text::make('Nom du déclencheur mobile (français)', 'mobile_trigger_fr')->hideFromIndex(),
              Text::make('Nom du déclencheur mobile (anglais)', 'mobile_trigger_en')->hideFromIndex(),
              Text::make('Temps de déclenchement', 'trigger_time')->hideFromIndex(),

            ],
        ])),
        ];
    }

    public static function group()
    {
        return __('group:publication');
    }

    public function cards(Request $request)
    {
        return [
            new \App\Nova\Metrics\NewVoters,
            new \App\Nova\Metrics\NewVotes,
            new \App\Nova\Metrics\VotePerDay,
        ];
    }

    public static function validatorForCreation(NovaRequest $request)
    {
        $rules = self::rulesForCreation($request);
        $rules['slug'] = [];

        return Validator::make($request->all(), $rules)
                ->after(function ($validator) use ($request) {
                    static::afterValidation($request, $validator);
                    static::afterCreationValidation($request, $validator);
                });
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
