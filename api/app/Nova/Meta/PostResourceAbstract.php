<?php

namespace App\Nova\Meta;

use Laravel\Nova\Resource as NovaResource;

use Illuminate\Support\Facades\Validator;
use Laravel\Nova\Http\Requests\NovaRequest;

use Eminiarts\Tabs\Tabs;

use Illuminate\Http\Request;

use App\Models\Heading;
use App\Models\PostType;
use App\Models\Post;

use App\Nova\Filters\PostStatusFilter;
use App\Nova\Filters\PostHeadingFilter;
use App\Nova\Filters\PostCategoryFilter;

use App\Helpers\NovaToolbox;

use App\Nova\Forms\Post\PostForm;
use App\Nova\Forms\Post\ExternalPostForm;
use App\Nova\Forms\Post\ContributionPostForm;

use App\Nova\Actions\CreateExternalArticle;
use App\Nova\Actions\CreateContribution;

use Eminiarts\Tabs\TabsOnEdit;
use DigitalCreative\ConditionalContainer\HasConditionalContainer;

abstract class PostResourceAbstract extends NovaResource
{
    use TabsOnEdit, HasConditionalContainer;

    public static $globallySearchable = false;
    public static $perPageOptions = [10, 25, 50];

    protected function getModelInstance()
    {
        $resourceKey = explode('/', request()->path())[1];

        $resourceClass = Nova::resourceForKey($resourceKey);

        return new $resourceClass::$model;
    }

    public function fieldsForCreate(Request $request)
    {
        $params = NovaToolbox::query($request);

        if (isset($params['external']) && $params['external']) {
            return ExternalPostForm::make($request, static::heading());
        } elseif (isset($params['contribution']) && $params['contribution']) {
            return ContributionPostForm::make($request, static::heading());
        }
        return PostForm::make($request, static::heading());
    }

    public function fieldsForUpdate(Request $request)
    {
        if ($this->category === 'external') {
            return ExternalPostForm::make($request, static::heading());
        } elseif ($this->category === 'contribution') {
            return ContributionPostForm::make($request, static::heading());
        }
        return PostForm::make($request, static::heading());
    }

    public function fieldsForDetail(Request $request)
    {
        if ($this->category === 'external') {
            return ExternalPostForm::make($request, static::heading());
        } elseif ($this->category === 'contribution') {
            return ContributionPostForm::make($request, static::heading());
        }
        return PostForm::make($request, static::heading());
    }

    public function fields(Request $request)
    {
        return PostForm::make($request, static::heading());
    }


    public function cards(Request $request)
    {
        return [
            new \App\Nova\Metrics\PostType(static::heading()),
            new \App\Nova\Metrics\PostByDepartment(static::heading()),
        ];
    }

    public function filters(Request $request)
    {
        return [
          PostHeadingFilter::make(static::heading()),
          PostStatusFilter::make(),
          PostCategoryFilter::make(),
       ];
    }

    public static function group()
    {
        return __('group:heading');
    }

    public static function createButtonLabel()
    {
        return __('Publish :resource', ['resource' => static::singularLabel()]);
    }

    public function actions(Request $request)
    {
        return [
           (CreateExternalArticle::make()
               ->onlyOnIndexToolbar()
               ->withMeta(['resource'=> static::uriKey()])),
           (CreateContribution::make()
               ->onlyOnIndexToolbar()
               ->withMeta(['resource'=> static::uriKey()])),
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
}
