<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

use App\Models\States\Category\Article;
use App\Models\States\Category\External;
use App\Models\States\Category\Contribution;
use App\Models\States\StateHelper;

use App\Models\States\Heading\AllPosts;

class PostType extends Partition
{
    public $name = 'Type d\'article';

    public $width = '1/2';

    public $heading;

    public function __construct($heading = null)
    {
        $this->heading = $heading;
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $q = null;

        if ($this->heading === AllPosts::$key) {
            $q = $this->count($request, \App\Models\Post::class, 'category');
        } else {
            $q = $this->count($request, \App\Models\Post::where('heading', $this->heading), 'category');
        }
        return $q->label(function ($value) {
            switch ($value) {
                   case Article::$key:
                       return (new Article)->label('fr');
            case External::$key:
                       return (new External)->label('fr');
            case Contribution::$key:
                       return (new Contribution)->label('fr');
            default:
                       return ucfirst($value);
        }
        });
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'post-type';
    }
}
