<?php

namespace App\Nova\Actions;

use Brightspot\Nova\Tools\DetachedActions\DetachedAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;

class CreateExternalArticle extends DetachedAction
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle(ActionFields $fields, Collection $models)
    {
        $resource = $this->meta['resource'];
        return DetachedAction::push('/resources/'.$resource.'/new?external=true');
    }

    public function label()
    {
        return __('action:addExternal');
    }

    public function name()
    {
        return __('action:addExternal');
    }

    public $withoutConfirmation = true;

    public $withoutActionEvents = true;
}
