<?php

declare(strict_types=1);

namespace SeoMunk\SeoMunk\Modules\Meta;

final class MetaData
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?string $canonicalUrl = null,
        public ?string $robots = null,
        public ?string $image = null,
        public ?string $author = null,
        public string $ogType = 'website',
        public string $twitterCard = 'summary_large_image',
        public ?string $siteName = null,
        public ?string $url = null,
    ) {}
}