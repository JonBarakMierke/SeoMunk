<?php

declare(strict_types=1);

namespace SeoMunk\SeoMunk;

use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaBuilder;
use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaManager;

class SeoMunk
{
    public function __construct(
        private readonly SchemaBuilder $schemaBuilder,
        private readonly SchemaManager $schemaManager,
    ) {}

    public function schema(): SchemaBuilder
    {
        return $this->schemaBuilder;
    }

    public function schemas(): SchemaManager
    {
        return $this->schemaManager;
    }
}
