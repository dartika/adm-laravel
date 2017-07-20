<?php

namespace Dartika\Adm\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdmServiceProvider extends ServiceProvider
{
    protected $packagename = 'dartika-adm';

    protected $providers = [
        \Dartika\Adm\Providers\AdmRoutingServiceProvider::class
    ];

    public function boot()
    {
        $this->publish();

        $this->load();
    }

    public function register()
    {
        // providers
        $this->registerProviders($this->app);

        // adm exception handler
        $this->registerAdmExceptions($this->app);

        // adm middlewares
        $this->registerAdmMiddlewares($this->app);
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
            __DIR__ . '/../../public' => public_path("vendor/{$this->packagename}"),
        ], 'assets');
    }

    protected function load()
    {
        // config
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', $this->packagename);

        // migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // translationss
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', $this->packagename);

        // views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', $this->packagename);
    }

    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    protected function registerAdmExceptions($app)
    {
        $app->bind(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Dartika\Adm\Exceptions\AdmHandler::class
        );
    }

    protected function registerAdmMiddlewares($app)
    {
        $app['router']->aliasMiddleware('guestadm', \Dartika\Adm\Http\Middleware\RedirectIfAuthenticated::class);
    }

    protected function getConfig($key)
    {
        return $this->app['config']->get("{$this->packagename}.{$key}");
    }

    protected function getAdmPath($path)
    {
        return $this->getconfig('admPath') . $path;
    }
}
