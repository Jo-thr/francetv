<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Layout' => 'App\Policies\LayoutPolicy',
        'App\Models\MetaMedia' => 'App\Policies\MetaMediaPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Tag' => 'App\Policies\TagPolicy',
        'App\Models\Pictogram' => 'App\Policies\PictogramPolicy',
        'App\Models\Sponsor' => 'App\Policies\SponsorPolicy',
        'App\Models\Test' => 'App\Policies\TestPolicy',
        'App\Models\Departement' => 'App\Policies\ServicePolicy',
        'App\Models\Contact' => 'App\Policies\ContactPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
