<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\Validator;

use App\Nova\Forms\Layout\MainLayoutForm;
use App\Nova\Forms\Layout\HomeLayoutForm;
use App\Nova\Forms\Layout\MetaMediaLayoutForm;
use App\Nova\Forms\Layout\NarrativeLayoutForm;
use App\Nova\Forms\Layout\TestsLayoutForm;
use App\Nova\Forms\Layout\IndexForm;

use App\Models\States\LayoutType\Main;
use App\Models\States\LayoutType\Narrative;
use App\Models\States\LayoutType\Tests;
use App\Models\States\LayoutType\Home;
use App\Models\States\LayoutType\MetaMedia;

use App\Helpers\NovaToolbox;

use App\Models\Test;

class Layout extends Resource
{
    use TabsOnEdit;

    public static $model = \App\Models\Layout::class;
    public static $priority = 2;
    public static $title = 'label';

    public static $search = [ 'label' ];

    public function fields(Request $request)
    {
        if ($this->type === null) {
            $layout = Layout::find(NovaToolbox::resourceId($request));
            return IndexForm::make($layout->type);
        }
        return IndexForm::make($this->type);
    }

    public function fieldsForIndex(Request $request)
    {
        return IndexForm::make($this->type);
    }

    public function fieldsForDetail(Request $request)
    {
        switch ($this->type) {
            case Tests::$key:
                return TestsLayoutForm::make($request);
            case MetaMedia::$key:
                return MetaMediaLayoutForm::make($request);
            case Narrative::$key:
                return NarrativeLayoutForm::make();
            case Home::$key:
                return HomeLayoutForm::make($request);
            case Main::$key:
                return MainLayoutForm::make($request);
            default:
                return [];
        }
    }

    public function fieldsForUpdate(Request $request)
    {
        switch ($this->type) {
            case Home::$key:
                return HomeLayoutForm::make($request);
            case Tests::$key:
                return TestsLayoutForm::make($request);
            case MetaMedia::$key:
                return MetaMediaLayoutForm::make($request);
            case Narrative::$key:
                return NarrativeLayoutForm::make();
            case Main::$key:
                return MainLayoutForm::make($request);
            default:
                $layout = Layout::find(NovaToolbox::resourceId($request));
                return IndexForm::make($layout->type);
        }
    }

    public static function group()
    {
        return __('group:publication');
    }

    public static function label()
    {
        return __('layout:label');
    }

    public static function singularLabel()
    {
        return __('layout:labelSingular');
    }

    /**
     * Create a validator instance for a resource update request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource|null  $resource
     * @return \Illuminate\Validation\Validator
     */
    public static function validatorForUpdate(NovaRequest $request, $resource = null)
    {
        $rules = static::rulesForUpdate($request, $resource);

        $rules['block1_type'] = [];
        $rules['block2_type'] = [];
        $rules['block3_type'] = [];
        $rules['block4_type'] = [];
        $request['participate_insert1_type'] = [];

        if($resource->type) {
            if ($resource->type === Narrative::$key) {
                $request['block1_type'] = \App\Models\Post::class;
                $request['block2_type'] = \App\Models\Post::class;
                $request['block3_type'] = \App\Models\Post::class;
                $request['block4_type'] = \App\Models\Post::class;
                $request['participate_insert1_type'] = \App\Models\Post::class;
                $request['agenda_insert1_type'] = \App\Models\Post::class;
            }
            if ($resource->type === Tests::$key) {
                $request['block1_type'] = \App\Models\Test::class;
                $request['block2_type'] = \App\Models\Post::class;
                $request['block3_type'] = \App\Models\Test::class;
            }
            if ($resource->type === Main::$key) {
                $request['block1_type'] = \App\Models\Post::class;
                $request['block2_type'] = \App\Models\Post::class;
                $request['block3_type'] = \App\Models\Post::class;
            }
            if ($resource->type === MetaMedia::$key) {
                $request['block1_type'] = \App\Models\MetaMedia::class;
                $request['block2_type'] = \App\Models\MetaMedia::class;
                $request['block3_type'] = \App\Models\MetaMedia::class;
            }
        }

        return Validator::make($request->all(), $rules)
                ->after(function ($validator) use ($request) {
                    static::afterValidation($request, $validator);
                    static::afterUpdateValidation($request, $validator);
                });
    }
}
