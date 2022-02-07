<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

use App\Policies\RolePolicy;
use App\Policies\PermissionPolicy;
use Advoor\NovaEditorJs\NovaEditorJs;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 9999;
        });

        Nova::serving(function () {
            Nova::script('heading', public_path('js/editor-js-plugins/heading.js'));
            Nova::script('quote', public_path('js/editor-js-plugins/quote.js'));
            Nova::script('list', public_path('js/editor-js-plugins/list.js'));
        });

        NovaEditorJs::addRender('quote', function ($block) {
            return view('vendor.nova-editor-js.quote', $block['data'])->render();
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new \App\Nova\Metrics\NewVoters,
            new \App\Nova\Metrics\NewVotes,
            new \App\Nova\Metrics\VotePerDay,
            (new \App\Nova\Metrics\LastTests)->title('Derniers tests'),
            (new \App\Nova\Metrics\LastArticles)->title('Derniers articles'),
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        if (env('APP_ENV') === 'local') {
            return [
                new \Infinety\Filemanager\FilemanagerTool(),
                \Vyuldashev\NovaPermission\NovaPermissionTool::make()
                ->rolePolicy(RolePolicy::class)
                ->permissionPolicy(PermissionPolicy::class),
            ];
        }
        return [
            new \Infinety\Filemanager\FilemanagerTool(),
            \Vyuldashev\NovaPermission\NovaPermissionTool::make()
            ->rolePolicy(RolePolicy::class)
            ->permissionPolicy(PermissionPolicy::class),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
