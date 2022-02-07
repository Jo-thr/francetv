<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\States\Heading\AllPosts;

class PostHeadingFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = '';

    private $category;

    public function __construct($value)
    {
        $this->category = $value;
    }

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
        if ($value === AllPosts::$key) {
            return $query;
        }
        return $query->where('heading', $value);
    }

    public function default()
    {
        return $this->category;
    }


    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [];
    }
}
