<?php

namespace App\Nova\Forms\Layout;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Models\Post;
use App\Rules\VerifyMaxByLang;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\Boolean;
use NovaErrorField\Errors;
use OptimistDigital\MultiselectField\Multiselect;
use Yna\NovaSwatches\Swatches;

class NarrativeLayoutForm
{
    public static function make()
    {
        return [
            Errors::make(),

            Text::make(__('field:page'), 'label')
                ->sortable()
                ->readOnly(function ($request) {
                    return !$request->user()->hasRole('superadmin');
                }),

            (new Tabs('Tabs', [
                'Header' => [
                    Multiselect::make('Raccourcis', 'shortcut')
                        ->options([
                            '/recherche?query=AR' => "AR",
                            '/recherche?query=VR' => 'VR',
                            '/recherche?query=Les%20prim%C3%A9s' => 'Les primés',
                            '/recherche?query=Immersion' => 'Immersion',
                            '/recherche?query=fiction' => 'Fiction',
                            '/recherche?query=animation' => 'Animation',
                            '/recherche?query=documentaires' => 'Documentaires'
                        ])
                        ->max(8)
                        ->saveAsJSON(true)
                        ->reorderable()
                        ->hideFromIndex()
                        ->rules('required'),


                    NovaEditorJs::make('Sous-titre', 'subtitle')
                        ->stacked()
                        ->hideFromIndex()
                        ->rules(
                            'required',
                            function ($attribute, $value, $fail) {
                                $count = 0;
                                foreach(json_decode($value)->blocks as $block) {
                                    $count += strlen(trim(html_entity_decode($block->data->text)));
                                }
                                if ($count > 352) {
                                    $fail("Le texte de Sous-titre ne peut contenir plus de 350 caractères");
                                }
                            }
                        ),
                ],
                __('layout:mainBlock') => [

                    BelongsTo::make(__('field:featuredPost'), 'block1', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->rules('required'),
                    Hidden::make('block1_type')->default(function () {
                        return $this->block1_type;
                    }),

                    BelongsTo::make('2ème article', 'block2', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->rules('required'),
                    Hidden::make('block2_type')->default(function () {
                        return $this->block2_type;
                    }),

                    BelongsTo::make('3ème article', 'block3', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->rules('required'),
                    Hidden::make('block3_type')->default(function () {
                        return $this->block3_type;
                    }),

                    BelongsTo::make('4ème article', 'block4', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('block4_type')->default(function () {
                        return $this->block4_type;
                    }),

                ],
                "Co-production" => [

                    Text::make('Titre', 'coProdTitle')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            'required',
                            'max:85'
                        ]),

                    TextArea::make('Sous-titre', 'coProdSubTitle')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules(['required', 'max:200']),

                ],

                "Agenda" => [

                    Text::make('Titre', 'agendaTitle')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            'required',
                            new VerifyMaxByLang(85)
                        ]),

                    TextArea::make('Sous-titre', 'agendaSubTitle')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules(['required', new VerifyMaxByLang(200)]),
                    

                    Heading::make('1er encart'),
                    BelongsTo::make('Article', 'agenda_insert1', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('agenda_insert1_type')->default(function () {
                        return Post::class;
                    }),
                    Date::make('Date de début', 'agenda_insert1_startDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['required_with:agenda_insert1']),
                    Date::make('Date de fin', 'agenda_insert1_endDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['exclude_without:agenda_insert1', 'required', 'after_or_equal:agenda_insert1_startDate']),
                    TextArea::make('Sous-titre', 'agenda_insert1_Description')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules('max:780'),

                    Heading::make('2eme encart'),
                    BelongsTo::make('Article', 'agenda_insert2', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('agenda_insert2_type')->default(function () {
                        return Post::class;
                    }),

                    Date::make('Date de début', 'agenda_insert2_startDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['required_with:agenda_insert2']),
                    Date::make('Date de fin', 'agenda_insert2_endDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['exclude_without:agenda_insert2', 'required', 'after_or_equal:agenda_insert2_startDate']),

                    TextArea::make('Sous-titre', 'agenda_insert2_Description')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules('max:780'),

                    Heading::make('3eme encart'),
                    BelongsTo::make('Article', 'agenda_insert3', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('agenda_insert3_type')->default(function () {
                        return Post::class;
                    }),

                    Date::make('Date de début', 'agenda_insert3_startDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['required_with:agenda_insert3']),
                    Date::make('Date de fin', 'agenda_insert3_endDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['exclude_without:agenda_insert3', 'required', 'after_or_equal:agenda_insert3_startDate']),

                    TextArea::make('Sous-titre', 'agenda_insert3_Description')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules('max:780'),

                    Heading::make('4eme encart'),
                    BelongsTo::make('Article', 'agenda_insert4', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('agenda_insert4_type')->default(function () {
                        return Post::class;
                    }),

                    Date::make('Date de début', 'agenda_insert4_startDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['required_with:agenda_insert4']),
                    Date::make('Date de fin', 'agenda_insert4_endDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['exclude_without:agenda_insert4', 'required', 'after_or_equal:agenda_insert4_startDate']),

                    TextArea::make('Sous-titre', 'agenda_insert4_Description')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules('max:780'),

                    Heading::make('5eme encart'),
                    BelongsTo::make('Article', 'agenda_insert5', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('agenda_insert5_type')->default(function () {
                        return Post::class;
                    }),

                    Date::make('Date de début', 'agenda_insert5_startDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['required_with:agenda_insert5']),
                    Date::make('Date de fin', 'agenda_insert5_endDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['exclude_without:agenda_insert5', 'required', 'after_or_equal:agenda_insert5_startDate']),

                    TextArea::make('Sous-titre', 'agenda_insert5_Description')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules('max:780'),

                    Heading::make('6eme encart'),
                    BelongsTo::make('Article', 'agenda_insert6', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('agenda_insert6_type')->default(function () {
                        return Post::class;
                    }),

                    Date::make('Date de début', 'agenda_insert6_startDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['required_with:agenda_insert6']),
                    Date::make('Date de fin', 'agenda_insert6_endDate')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['exclude_without:agenda_insert6', 'required', 'after_or_equal:agenda_insert6_startDate']),

                    TextArea::make('Sous-titre', 'agenda_insert6_Description')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules('max:780'),

                ],

                "Participez" => [

                    Text::make('Titre', 'participateTitle')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            'required',
                            'max:85'
                        ]),

                    TextArea::make('Sous-titre', 'participateSubTitle')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules(['required', new VerifyMaxByLang(200)]),

                    Heading::make('1er encart'),

                    BelongsTo::make('Article', 'participate_insert1', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('participate_insert1_type')->default(function () {
                        return Post::class;
                    }),

                    Textarea::make('Description', 'participate_insert1_Description')
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            new VerifyMaxByLang(350)
                        ]),

                    Text::make('Texte du boutton', 'participate_insert1_Button')
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            'max:25'
                        ]),

                    Heading::make('2ème encart'),

                    BelongsTo::make('Article', 'participate_insert2', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('participate_insert2_type')->default(function () {
                        return Post::class;
                    }),

                    Textarea::make('Description', 'participate_insert2_Description')
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            new VerifyMaxByLang(350)
                        ]),

                    Text::make('Texte du boutton', 'participate_insert2_Button')
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            'max:25'
                        ]),

                    Heading::make('3ème encart'),

                    BelongsTo::make('Article', 'participate_insert3', '\App\Nova\Article')
                        ->hideFromIndex()
                        ->searchable()
                        ->nullable(),
                    Hidden::make('participate_insert3_type')->default(function () {
                        return Post::class;
                    }),

                    Textarea::make('Description', 'participate_insert3_Description')
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            new VerifyMaxByLang(350)
                        ]),

                    Text::make('Texte du boutton', 'participate_insert3_Button')
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            'max:25'
                        ]),

                ],

                "Archives" => [

                    Text::make('Titre', 'archiveTitle')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules([
                            'required',
                            'max:85'
                        ]),

                    TextArea::make('Sous-titre', 'archiveSubTitle')
                        ->sortable()
                        ->translatable()
                        ->hideFromIndex()
                        ->rules(['required', new VerifyMaxByLang(200)]),

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
                        ->hideFromIndex()
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
                        ->hideFromIndex()
                        ->withProps([
                            'inline' => true,
                            'show-fallback' => false,
                            'fallback-type' => 'input',
                            'popover-to' => 'left',
                        ]),

                    Boolean::make(__('field:fontblack'), 'font_black')->hideFromIndex(),
                ],
            ])),
        ];
    }
}
