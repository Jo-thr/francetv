<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

use App\Models\Post;
use App\Models\States\StateHelper;

use App\Models\States\PublicationStatus\Draft;
use App\Models\States\PublicationStatus\Pending;
use App\Models\States\PublicationStatus\Published;

class PostStatusFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        switch ($value) {
            case Published::$key:
                return $query->where('published', true)->where('published_at', '<=', now());
                break;
            case Draft::$key:
                return $query->where('published', false);
                break;
            case Pending::$key:
                return $query->where('published', true)->where('published_at', '>', now());
                break;
            default:
                return $query;
        }
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return StateHelper::stateToArrayInverse(Post::$publicationStates);
    }
}
