<?php

namespace Dartika\Adm\Providers;

use Dartika\Adm\Providers\AdmServiceProvider;
use Illuminate\Support\Facades\Route;

class AdmRoutingServiceProvider extends AdmServiceProvider
{
    public function boot()
    {
        $this->load();
    }

    public function register()
    {
    }

    protected function load()
    {
        // routes
        $this->loadAdmRoutes();
    }

    protected function loadAdmRoutes()
    {
        $this->loadDefaultAdmRoutes();
        $this->loadCustomAdmRoutes();
    }

    protected function loadDefaultAdmRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/routes.php');
    }

    protected function loadCustomAdmRoutes()
    {
        if (file_exists($file = $this->getAdmPath('routes.php'))) {
            $this->app['router']->group([
                'prefix' => $this->getConfig('prefix'),
                'middleware' => 'auth:adm',
            ], function () {
                require $file;
            });
        }
    }
}
