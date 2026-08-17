<?php

declare(strict_types=1);

namespace SeoMunk\SeoMunk\Modules\Meta\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use SeoMunk\SeoMunk\Models\Meta;

trait HasSeoMeta
{
    public function seoMeta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'model');
    }

    public function seoMetaDefaults(): array
    {
        $profile = method_exists($this, 'geoProfile')
            ? $this->geoProfile()
            : [];

        return [
            'title' => $profile['name'] ?? null,
            'description' => $profile['description'] ?? null,
            'image' => $profile['image'] ?? null,
            'url' => $profile['url'] ?? null,
        ];
    }
}