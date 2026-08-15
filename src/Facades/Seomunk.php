<?php

declare(strict_types=1);

namespace Seomunk\Seomunk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Seomunk\Seomunk\Seomunk
 */
class Seomunk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Seomunk\Seomunk\Seomunk::class;
    }
}
