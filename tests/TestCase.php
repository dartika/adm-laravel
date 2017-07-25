<?php

namespace Dartika\Adm\Tests;

use Dartika\Adm\Tests\TestHelpers;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Storage;
use Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, TestHelpers;
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        
        Storage::fake('fs_test');
    }
}
