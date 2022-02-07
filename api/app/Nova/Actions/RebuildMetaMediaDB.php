<?php

namespace App\Nova\Actions;

use App\Helpers\MetaMediaFetcher;
use App\Models\MetaMedia;
use Brightspot\Nova\Tools\DetachedActions\DetachedAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class RebuildMetaMediaDB extends DetachedAction
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        MetaMediaFetcher::fetch(50, true);

        return Action::redirect('/admin/resources/meta-medias');
    }

    public function label()
    {
        return __('action:rebuildMetaMedia');
    }

    public function name()
    {
        return __('action:rebuildMetaMedia');
    }
}
