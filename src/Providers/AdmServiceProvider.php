<?php

namespace Dartika\Adm\Providers;

use Dartika\Adm\Routes\RouteLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdmServiceProvider extends ServiceProvider
{
    protected $packagename = 'dartika-adm';

    protected $providers = [];

    protected $consoleCommands = [
        \Dartika\Adm\Console\Commands\InstallerCommand::class
    ];

    /**
     * Register
     */

    public function register()
    {
        // providers
        $this->registerProviders();

        // adm middlewares
        $this->registerAdmMiddlewares();

        // console commands
        $this->registerConsoleCommands();

        // config
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', $this->packagename);

        // load routes
        $routeLoader = new RouteLoader($this->app['router']);
        $routeLoader->load();
    }

    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    protected function registerAdmMiddlewares()
    {
        $this->app['router']->aliasMiddleware('guestadm', \Dartika\Adm\Http\Middleware\RedirectIfAuthenticated::class);
    }

    protected function registerConsoleCommands()
    {
        foreach ($this->consoleCommands as $consoleCommand) {
            $this->commands($consoleCommand);
        }
    }

    /**
     * Boot
     */

    public function boot()
    {
        $this->publish();

        $this->load();

        $this->setAdmGuard();
    }    

    protected function publish()
    {
        // config
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path("{$this->packagename}.php"),
        ], 'config');

        // translations
        $this->publishes([
            __DIR__ . '/../../resources/lang' => resource_path("lang/vendor/{$this->packagename}"),
        ], 'translations');

        // views
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path("views/vendor/{$this->packagename}"),
        ], 'views');

        // assets
        $this->publishes([
            __DIR__ . "/../../public/vendor/{$this->packagename}" => public_path("vendor/{$this->packagename}"),
        ], 'assets');
    }

    protected function load()
    {
        // migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // translationss
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', $this->packagename);

        // views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', $this->packagename);
    }

    protected function setAdmGuard()
    {
        config(['auth.guards.adm' => [
            'driver' => 'session',
            'provider' => 'adm_users'
        ]]);

        config(['auth.providers.adm_users' => [
            'driver' => 'eloquent',
            'model' => 'Dartika\Adm\Models\AdmUser'
        ]]);
    }
}
