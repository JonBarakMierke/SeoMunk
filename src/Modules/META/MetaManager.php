<?php

declare(strict_types=1);

namespace SeoMunk\SeoMunk\Modules\Meta;

use Illuminate\Database\Eloquent\Model;

final class MetaManager
{
    private MetaData $data;

    public function __construct()
    {
        $this->data = new MetaData(
            robots: config('seomunk.meta.default_robots'),
            image: config('seomunk.meta.fallback_image'),
            siteName: config('seomunk.meta.site_name'),
            description: config('seomunk.meta.fallback_description'),
            url: request()->url(),
            canonicalUrl: request()->url(),
        );
    }

    public function title(?string $title): static
    {
        $this->data->title = $title;

        return $this;
    }

    public function description(?string $description): static
    {
        $this->data->description = $description;

        return $this;
    }

    public function canonical(?string $url): static
    {
        $this->data->canonicalUrl = $url;

        return $this;
    }

    public function image(?string $image): static
    {
        $this->data->image = $image;

        return $this;
    }

    public function robots(?string $robots): static
    {
        $this->data->robots = $robots;

        return $this;
    }

    public function author(?string $author): static
    {
        $this->data->author = $author;

        return $this;
    }

    public function ogType(string $type): static
    {
        $this->data->ogType = $type;

        return $this;
    }

    public function twitterCard(string $card): static
    {
        $this->data->twitterCard = $card;

        return $this;
    }

    public function siteName(?string $siteName): static
    {
        $this->data->siteName = $siteName;

        return $this;
    }

    public function url(?string $url): static
    {
        $this->data->url = $url;

        return $this;
    }

    public function data(): MetaData
    {
        return $this->data;
    }
}