<?php

namespace ForWebSystem\Autentique;

use Illuminate\Support\ServiceProvider;

class AutentiqueServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'forwebsystem');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'forwebsystem');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/autentique.php', 'autentique');

        // Register the service the package provides.
        $this->app->singleton('autentique', function ($app) {
            return new Autentique;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['autentique'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/autentique.php' => config_path('autentique.php'),
        ], 'autentique.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/forwebsystem'),
        ], 'autentique.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/forwebsystem'),
        ], 'autentique.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/forwebsystem'),
        ], 'autentique.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
