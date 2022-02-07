<?php

namespace App\Nova\Metrics;

use App\Models\Test;
use ThijsSimonis\NovaListCard\NovaListCard;

class LastTests extends NovaListCard
{
    public $width = '1/2';

    public function __construct()
    {
        parent::__construct();

        $this->rows(
            Test::select(['id','title->fr'])->orderBy('created_at', 'DESC')->limit(5)->get()->map(function ($row) {
                $row['view'] = config('nova.path') . '/resources/tests/' . $row['id'];
                unset($row['id']);
                return $row;
            })
        );
    }

    public function uriKey(): string
    {
        return 'latest-tests';
    }
}
