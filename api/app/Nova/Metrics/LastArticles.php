<?php

namespace App\Nova\Metrics;

use App\Models\Post;
use App\Models\Heading;
use ThijsSimonis\NovaListCard\NovaListCard;

class LastArticles extends NovaListCard
{
    public $width = '1/2';

    public function __construct()
    {
        parent::__construct();

        $this->rows(
            Post::select(['id','heading','title->fr'])->orderBy('created_at', 'DESC')->limit(5)->get()->map(function ($row) {
                $row['heading'] = isset($row['heading'])
                ? Heading::byKey($row['heading'])
                : __('post:labelSingular');
                $row['view'] = config('nova.path') . '/resources/articles/' . $row['id'];
                unset($row['id']);
                return $row;
            })
        );
    }

    public function uriKey(): string
    {
        return 'latest-posts';
    }
}
