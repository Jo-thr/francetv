<?php

namespace App\Nova\Actions;

use App\Helpers\MetaMediaFetcher;
use App\Models\MetaMedia;
use Brightspot\Nova\Tools\DetachedActions\DetachedAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class FetchMetaMedia extends DetachedAction
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        MetaMediaFetcher::fetch(5);

        return Action::redirect('/admin/resources/meta-medias');
    }

    public function label()
    {
        return __('action:fetchMetaMedia');
    }

    public function name()
    {
        return __('action:fetchMetaMedia');
    }

    public function fields()
    {
        return [];
    }
}
