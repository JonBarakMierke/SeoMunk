<?php

declare(strict_types=1);

namespace SeoMunk\SeoMunk\Modules\JSON\Schema;

final class BuildAutomaticSchema
{
    public function __construct(
        private readonly SchemaBuilder $builder,
    ) {}

    public function handle(mixed $model): SchemaBuilder
    {
        if (! $model || ! method_exists($model, 'geoProfile')) {
            return $this->builder;
        }

        $profile = $model->geoProfile();

        if (
            config('seo-munk.schema.include_products')
            && ! empty($profile['product'])
        ) {
            $this->builder->withProduct($profile['product']);
        }

        if (
            config('seo-munk.schema.include_faq')
            && ! empty($profile['faqs'])
        ) {
            $this->builder->withFAQ($profile['faqs']);
        }

        if (
            config('seo-munk.schema.include_reviews')
            && ! empty($profile['reviews'])
        ) {
            $this->builder->withReviews($profile['reviews']);
        }

        if (
            config('seo-munk.schema.include_breadcrumb')
            && ! empty($profile['breadcrumb'])
        ) {
            $this->builder->withBreadcrumb($profile['breadcrumb']);
        }

        if (
            config('seo-munk.schema.include_raw_json')
            && ! empty($profile['raw_json'])
        ) {
            $this->builder->withRawJson($profile['raw_json']);
        }

        return $this->builder;
    }
}