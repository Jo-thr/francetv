<?php

namespace App\Nova\Actions;

use Brightspot\Nova\Tools\DetachedActions\DetachedAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class CreateContribution extends DetachedAction
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        $resource = $this->meta['resource'];
        return Action::push('/resources/'.$resource.'/new?contribution=true');
    }

    public function label()
    {
        return __('action:addContribution');
    }

    public function name()
    {
        return __('action:addContribution');
    }

    public $withoutConfirmation = true;

    public $withoutActionEvents = true;
}
