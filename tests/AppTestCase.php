<?php

namespace Dartika\Adm\Tests;

use Tests\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Factory as ModelFactory;
use Dartika\Adm\Tests\TestHelpers;

abstract class AppTestCase extends BaseTestCase
{
    use TestHelpers;
    
    public function setUp()
    {
        parent::setUp();

        $this->loadFactories(__DIR__ . '/factories');
    }

    protected function loadFactories($path) {
        $this->app->make(ModelFactory::class)->load($path);

        return $this;
    }
}
