# SeoMunk

SeoMunk is an open-source Laravel package for SEO and AI Search Optimization (AIO/GEO).

The package is designed to provide a flexible, Laravel-native way to manage:

* Meta tags and SEO data
* JSON-LD structured data
* Automatic schema generation from models
* Manually defined schemas
* FAQ, Product, Organization, Breadcrumb, Review, and other Schema.org types
* Raw JSON-LD schemas

> **Current status:** Early development. The API is actively evolving and should not yet be considered stable.

## Installation

Install SeoMunk through Composer:

```bash
composer require jon-mierke/seomunk
```

Publish the configuration:

```bash
php artisan vendor:publish --tag=seomunk-config
```

## JSON-LD Schema

SeoMunk provides a fluent API for adding JSON-LD structured data to a page.

Include the JSON-LD head component in your layout:

```blade
<x-json-head />
```

The component renders all schemas that have been registered for the current request.

### Adding a Schema

Schemas can be added using the `SeoMunk` facade:

```php
use SeoMunk\SeoMunk\Facades\SeoMunk;

SeoMunk::schema()->schema([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'About Us',
]);
```

The schema will be available to `<x-json-head />` when the page is rendered.

## Schema Types

SeoMunk provides convenience methods for common Schema.org types.

For example, an FAQ schema can be added with:

```php
SeoMunk::schema()->withFAQ([
    [
        'question' => 'What is SeoMunk?',
        'answer' => 'SeoMunk is a Laravel package for SEO and AI Search Optimization.',
    ],
    [
        'question' => 'Does SeoMunk support JSON-LD?',
        'answer' => 'Yes.',
    ],
]);
```

Multiple schemas can be chained together:

```php
SeoMunk::schema()
    ->withFAQ($faqs)
    ->withProduct($product)
    ->withBreadcrumb($breadcrumbs);
```

The resulting schemas are all rendered by:

```blade
<x-json-head />
```

## Raw JSON-LD

If you already have JSON-LD and don't want to use one of SeoMunk's schema builders, raw JSON can be added:

```php
SeoMunk::schema()->withRawJson($json);
```

For example:

```php
SeoMunk::schema()->withRawJson('
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "About Us"
}
');
```

Raw JSON is converted into SeoMunk's internal schema representation before rendering.

## Using Schemas in Controllers

Schemas don't need to come from a model.

They can be registered directly from a controller:

```php
use SeoMunk\SeoMunk\Facades\SeoMunk;

public function show()
{
    SeoMunk::schema()
        ->schema([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => 'About Us',
        ]);

    return view('about');
}
```

Your Blade layout only needs:

```blade
<x-json-head />
```

This separation allows controllers, services, models, and other parts of the application to contribute schemas without the head component needing to know where they came from.

## Automatic Schema Generation

SeoMunk is also designed to support automatic schema generation from models.

Models can expose a `geoProfile()` method containing the information needed to generate their schemas.

For example:

```php
public function geoProfile(): array
{
    return [
        'product' => [
            // Product schema data
        ],

        'faqs' => [
            [
                'question' => 'What is this product?',
                'answer' => '...',
            ],
        ],
    ];
}
```

SeoMunk can then use its automatic schema builder to inspect the model and register the appropriate schemas.

Automatic schema generation is intended to be an optional convenience rather than a requirement. Applications can use manually registered schemas without implementing `geoProfile()`.

## Rendering

SeoMunk's JSON-LD schemas are rendered as standard JSON-LD script tags:

```html
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "About Us"
}
</script>
```

The application only needs to include the component:

```blade
<x-json-head />
```

SeoMunk handles collecting and rendering the schemas registered during the request.

## Configuration

SeoMunk's configuration is stored in:

```text
config/seomunk.php
```

Schema-specific settings are located under:

```php
config('seomunk.schema');
```

For example:

```php
config('seomunk.schema.include_organization');
```

Configuration will continue to evolve as SeoMunk's schema and SEO functionality expands.

## Architecture

SeoMunk is being designed around independent modules rather than a single product-focused schema system.

The current JSON-LD architecture is roughly:

```text
SeoMunk
│
├── SchemaManager
│   └── Maintains schemas for the current request
│
├── SchemaBuilder
│   └── Provides fluent methods for adding schemas
│
├── BuildAutomaticSchema
│   └── Builds schemas from supported models
│
└── SchemaTypes
    ├── Product
    ├── FAQ
    ├── Review
    ├── Breadcrumb
    ├── Organization
    └── ...
```

The goal is for all schema sources to eventually converge into the same schema manager.

This allows SeoMunk to support:

```text
Model
Controller
Route
Service
Manual schema
Automatic schema
Raw JSON-LD
       │
       ▼
SchemaManager
       │
       ▼
<x-json-head />
```

## Project Status

SeoMunk is currently under active development.

The API, configuration structure, schema types, and module architecture may change before the first stable release.

Contributions, ideas, bug reports, and architectural feedback are welcome.

## License

SeoMunk is open-sourced software licensed under the [MIT license](LICENSE).
