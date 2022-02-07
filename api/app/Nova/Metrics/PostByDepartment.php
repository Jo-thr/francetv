<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use App\Models\States\Heading\AllPosts;
use DB;

class PostByDepartment extends Partition
{
    public $name = 'Article par service';

    public $width = '1/2';

    public $heading;

    public function __construct($heading = null)
    {
        $this->heading = $heading;
    }

    public function calculate(NovaRequest $request)
    {
        $q = \App\Models\Departement::select(DB::raw('count(*) as count, departements.name'))
        ->join('users', 'departements.id', '=', 'users.departement_id')
        ->join('posts', 'users.id', '=', 'posts.user_id');

        if ($this->heading !== AllPosts::$key) {
            $q->where('posts.heading', $this->heading);
        }

        $q->groupBy('departements.name')->get();

        $result = $q->pluck('count', 'name')->toArray();
        return $this->result($result);
    }

    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    public function uriKey()
    {
        return 'post-by-department';
    }
}
