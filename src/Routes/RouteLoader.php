<?php

namespace Dartika\Adm\Routes;

use Illuminate\Routing\Router;

class RouteLoader
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function load()
    {
        $this->loadDefaultAdmRoutes();
        $this->loadCustomAdmRoutes();
    }

    protected function loadCustomAdmRoutes()
    {
        if (file_exists($file = $this->getAdmPath('routes.php'))) {
            $this->router->group([
                'prefix' => config('dartika-adm.prefix'),
                'middleware' => ['web', 'auth:adm'],
            ], function () use ($file) {
                require $file;
            });
        }
    }

    protected function loadDefaultAdmRoutes()
    {
        $this->router->group([
            'namespace' => 'Dartika\Adm\Http\Controllers',
            'as' => 'dartika-adm.',
            'prefix' => config('dartika-adm.prefix'),
            'middleware' => ['web'],
        ], function () {
            require __DIR__ . '/routes.php';
        });
    }

    protected function getAdmPath($path)
    {
        return base_path() . '/' . config('dartika-adm.admPath') . "/{$path}";
    }
}
