<?php
namespace Proshore\EmailTemplates;

use Illuminate\Support\ServiceProvider;
/**
 * Class EmailTemplatesServiceProvider
 * @package Proshore\EmailTemplates
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
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'proshore-email-templates');

        //public config
        $this->publishes([
            __DIR__ . '/config/settings.php' => config_path('proshore-email-templates.php'),
        ], 'config');

        //publish views
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/proshore-email-templates')
        ], 'views');

        //publish migration files
        $this->publishes([
            __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');

        //publish assets
        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/proshore-email-templates')
        ], 'public');

        //pass layout name to view
        view()->share('current_layout', config('proshore-email-templates.layout-extend-path'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //register controllers

        $this->mergeConfigFrom(
            __DIR__ . '/config/settings.php', 'proshore-email-templates'
        );


        $this->app->bind('proshore-email-templates', function () {
            return new EmailTemplates;
        });
    }
}
