<?php

namespace Dartika\Adm\Tests;

use Dartika\Adm\Tests\TestHelpers;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use TestHelpers;

    protected function setUp()
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/factories');

        $this->artisan('migrate', ['--database' => 'testbench']);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            'Dartika\Adm\Providers\AdmServiceProvider',
            'Laracasts\Flash\FlashServiceProvider'
        ];
    }
}
