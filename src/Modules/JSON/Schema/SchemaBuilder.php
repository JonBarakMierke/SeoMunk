<?php

namespace SeoMunk\SeoMunk\Modules\JSON\Schema;

use InvalidArgumentException;
use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaTypes\Breadcrumb;
use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaTypes\FAQ;
use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaTypes\Org;
use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaTypes\Product;
use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaTypes\Review;

final class SchemaBuilder
{

    public function __construct(
        private readonly SchemaManager $manager,
    ) {}

    public function withProduct(array $faqs): static
    {
        if (!empty($faqs)) {
            $this->manager->add((new Product($faqs))->toArray());
        }
        return $this;
    }

    public function withFAQ(array $faqs): static
    {
        if (!empty($faqs)) {
            $this->manager->add((new FAQ($faqs))->toArray());
        }
        return $this;
    }

    public function withReviews($reviews): static
    {
        if ($reviews && count($reviews)) {
            $this->manager->add((new Review($reviews))->toArray());
        }
        return $this;
    }

    public function withBreadcrumb(array $breadcrumbs): static
    {
        if (!empty($breadcrumbs)) {
            $this->manager->add((new Breadcrumb($breadcrumbs))->toArray());
        }
        return $this;
    }

    public function organization(array $data = []): static
    {
        $this->manager->add((new Org($data))->toArray());
        return $this;
    }

    public function withRawJson(string $json): static
    {
        $data = json_decode(
            $json,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        if (! is_array($data)) {
            throw new \InvalidArgumentException(
                'Raw JSON schema must decode to an array.'
            );
        }

        $this->manager->add($data);

        return $this;
    }
}