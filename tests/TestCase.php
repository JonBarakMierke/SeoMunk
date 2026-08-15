<?php

declare(strict_types=1);

namespace Seomunk\Seomunk\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Seomunk\Seomunk\SeomunkServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            SeomunkServiceProvider::class,
        ];
    }
}
