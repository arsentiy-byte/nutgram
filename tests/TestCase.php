<?php

declare(strict_types=1);

namespace Tests;

use App\Traits\ConfigTrait;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    use ConfigTrait;
    use DatabaseMigrations;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        if ( ! $this->isTestingEnvironment()) {
            throw new RuntimeException('The configs are incorrect, try clearing the cache');
        }

        $this->runDatabaseMigrations();
        $this->seed();
    }
}
