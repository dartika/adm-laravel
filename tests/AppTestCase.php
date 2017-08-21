<?php

namespace Dartika\Adm\Tests;

use Dartika\Adm\Tests\TestHelpers;
use Illuminate\Database\Eloquent\Factory as ModelFactory;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase as BaseTestCase;

abstract class AppTestCase extends BaseTestCase
{
    use TestHelpers;
    
    public function setUp()
    {
        parent::setUp();
        
        Storage::fake('fs_test');

        $this->loadFactories(__DIR__ . '/factories');
    }

    protected function loadFactories($path) {
        $this->app->make(ModelFactory::class)->load($path);

        return $this;
    }
}
