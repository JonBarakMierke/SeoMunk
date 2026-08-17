<?php

declare(strict_types=1);

namespace SeoMunk\SeoMunk\Facades;

use Illuminate\Support\Facades\Facade;
use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaManager;

/**
 * @see \Seomunk\Seomunk\Seomunk
 */
class SeoMunk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Seomunk\Seomunk\Seomunk::class;
    }

    public static function schema(): SchemaManager
    {
        return app(SchemaManager::class);
    }
}
