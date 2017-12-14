<?php

namespace Proshore\EmailTemplates;

use Illuminate\Support\ServiceProvider;

/**
 * Class EmailTemplatesServiceProvider.
 */
class EmailTemplatesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'proshore-email-templates');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        //public config
        $this->publishes([
            __DIR__.'/config/settings.php' => config_path('proshore.email-templates.php'),
        ], 'config');

        //publish views
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/proshore-email-templates'),
        ], 'views');

        //publish assets
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/proshore-email-templates'),
        ], 'public');

        //pass layout name to view
        view()->share('current_layout', config('proshore.email-templates.layout-extend-path'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //register controllers
        $this->app->make(
            \Proshore\EmailTemplates\Http\Controllers\EmailTemplatesController::class
        );

        $this->mergeConfigFrom(
            __DIR__.'/config/settings.php', 'proshore-email-templates'
        );

        $this->app->bind('proshore-email-templates', function () {
            return new EmailTemplates();
        });
    }
}
