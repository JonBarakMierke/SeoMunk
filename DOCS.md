

SeoMunk is organized into independent modules.

Currently, the package provides:

* **Meta** — HTML metadata and social sharing metadata
* **JSON** — JSON-LD structured data and Schema.org support

Both modules are accessed through the main `SeoMunk` facade.

```php
use SeoMunk\SeoMunk\Facades\SeoMunk;
```

---

# Meta

The Meta module is responsible for generating the metadata placed inside the `<head>` of a page.

Include the Meta component in your application's layout:

```blade
<x-meta-head />
```

The component renders the metadata currently registered with SeoMunk.

## Defining Metadata

Metadata can be explicitly defined using the `SeoMunk` facade:

```php
use SeoMunk\SeoMunk\Facades\SeoMunk;

SeoMunk::meta()
    ->title('About Us')
    ->description('Learn more about our company.')
    ->canonical(url('/about'));
```

Metadata methods are chainable.

For example:

```php
SeoMunk::meta()
    ->title('My Product')
    ->description('A description of my product.')
    ->image(asset('images/product.jpg'))
    ->canonical(url('/products/my-product'))
    ->ogType('product')
    ->twitterCard('summary_large_image');
```

## Supported Metadata

The Meta module currently supports:

* `title`
* `description`
* `canonical`
* `robots`
* `image`
* `author`
* `ogType`
* `twitterCard`
* `siteName`
* `url`

Example:

```php
SeoMunk::meta()
    ->title('My Page')
    ->description('My page description.')
    ->robots('index, follow')
    ->author('Jon Mierke')
    ->image(asset('images/og-image.jpg'))
    ->ogType('website')
    ->twitterCard('summary_large_image');
```

## Automatic Metadata From Models

SeoMunk can automatically generate metadata from Eloquent models.

Models can implement `seoMetaDefaults()`:

```php
public function seoMetaDefaults(): array
{
    return [
        'title' => $this->name,
        'description' => $this->description,
        'image' => $this->image,
        'url' => route('products.show', $this),
    ];
}
```

SeoMunk can then use the model as a source of default metadata.

Models may optionally use the `HasSeoMeta` concern to provide editable SEO metadata.

```php
use SeoMunk\SeoMunk\Modules\Meta\Concerns\HasSeoMeta;

class Product extends Model
{
    use HasSeoMeta;
}
```

This allows stored SEO metadata to override model-derived defaults.

## Metadata Precedence

SeoMunk is designed around a layered metadata system.

In general, values are resolved from lower-priority defaults toward higher-priority overrides:

```text
Configuration defaults
        ↓
Model-derived defaults
        ↓
Stored model SEO metadata
        ↓
Explicit SeoMunk::meta() values
```

The most specific value wins.

This allows an application to have automatic SEO metadata while still providing complete control over individual pages.

## Meta Component

Add the component to your application's main layout:

```blade
<head>
    <x-meta-head />

    {{-- Other head elements --}}
</head>
```

The component is intentionally responsible only for rendering the resolved metadata.

It does not need to know whether the metadata came from:

* configuration
* a model
* a database record
* a controller
* a route
* explicit `SeoMunk::meta()` calls

---

# JSON-LD Schema

The JSON module provides a fluent API for generating JSON-LD structured data.

Include the JSON-LD component in your layout:

```blade
<x-json-head />
```

The component renders all schemas registered during the current request.

## Adding a Schema

A generic Schema.org object can be registered using `schema()`:

```php
use SeoMunk\SeoMunk\Facades\SeoMunk;

SeoMunk::schema()->schema([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'About Us',
]);
```

This allows any valid Schema.org structure to be added without SeoMunk needing a dedicated schema type.

## Convenience Schema Types

SeoMunk also provides convenience methods for common schema types.

For example:

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

Multiple schema types can be combined:

```php
SeoMunk::schema()
    ->withProduct($product)
    ->withFAQ($faqs)
    ->withReviews($reviews)
    ->withBreadcrumb($breadcrumbs);
```

All registered schemas are rendered by:

```blade
<x-json-head />
```

## Raw JSON-LD

SeoMunk provides `withRawJson()` for JSON-LD that doesn't have a dedicated convenience method.

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

Raw JSON is decoded and normalized into SeoMunk's internal schema representation before rendering.

This provides an escape hatch for custom or uncommon Schema.org types.

---

# Automatic Schema Generation

JSON-LD schemas can also be generated automatically from Eloquent models.

Models can expose a `geoProfile()` method containing information that SeoMunk can use to determine which schemas should be generated.

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

        'reviews' => [
            // Review data
        ],

        'breadcrumb' => [
            // Breadcrumb data
        ],
    ];
}
```

Automatic schema generation is handled separately from rendering.

SeoMunk's automatic schema builder reads the model and registers the appropriate schemas with the schema manager.

This means models are **one possible source of schemas**, rather than being a requirement for using the JSON-LD system.

---

# Manual vs Automatic Usage

SeoMunk supports both automatic and explicit usage.

### Automatic

A model can provide SEO and schema information:

```php
$product->seoMetaDefaults();

$product->geoProfile();
```

SeoMunk can use these methods to build metadata and structured data automatically.

### Explicit

Applications can define everything manually:

```php
SeoMunk::meta()
    ->title('About Us')
    ->description('Learn about our company.');

SeoMunk::schema()
    ->schema([
        '@context' => 'https://schema.org',
        '@type' => 'AboutPage',
        'name' => 'About Us',
    ]);
```

### Combining both

Automatic values can be used as defaults while explicit values override them:

```php
SeoMunk::meta()
    ->from($product)
    ->title('Custom Product Title');

SeoMunk::schema()
    ->withProduct($product)
    ->withFAQ($faqs);
```

This is one of the core design principles of SeoMunk: **automation should be convenient, not restrictive.**

---

# Blade Components

SeoMunk currently provides two primary head components.

### Meta

```blade
<x-meta-head />
```

Responsible for rendering:

* `<title>`
* `<meta name="description">`
* `<meta name="robots">`
* canonical URLs
* Open Graph tags
* Twitter/X card tags
* other metadata managed by the Meta module

### JSON-LD

```blade
<x-json-head />
```

Responsible for rendering:

```html
<script type="application/ld+json">
    ...
</script>
```

blocks generated by the JSON-LD module.

A typical layout may therefore contain:

```blade
<head>
    <x-meta-head />
    <x-json-head />
</head>
```

---

# Architecture

SeoMunk is designed around independent modules with a common philosophy:

> **Build data first. Render it separately.**

The current architecture is roughly:

```text
SeoMunk
│
├── Meta
│   ├── MetaManager
│   ├── MetaData
│   ├── BuildAutomaticMeta
│   └── HasSeoMeta
│
└── JSON
    └── Schema
        ├── SchemaManager
        ├── SchemaBuilder
        ├── BuildAutomaticSchema
        └── SchemaTypes
            ├── Product
            ├── FAQ
            ├── Review
            ├── Breadcrumb
            └── Organization
```

The main facade provides access to the modules:

```php
SeoMunk::meta();

SeoMunk::schema();
```

This keeps the public API simple while allowing each module to remain independently organized.

---

# Design Philosophy

SeoMunk is intentionally designed to avoid requiring a specific application architecture.

SEO data can come from:

* Eloquent models
* database records
* controllers
* routes
* configuration
* application services
* manually defined arrays
* raw JSON-LD

The package should not require applications to structure their models in a specific way just to use SeoMunk.

Automatic functionality is provided as a convenience, while manual APIs remain available when developers need complete control.

---

# Configuration

SeoMunk's configuration is stored in:

```text
config/seomunk.php
```

Publish it with:

```bash
php artisan vendor:publish --tag=seomunk-config
```

Configuration is organized by module.

For example:

```php
config('seomunk.meta');
```

and:

```php
config('seomunk.schema');
```

Module-specific configuration will continue to evolve as SeoMunk develops.

---

# Development Status

SeoMunk is currently in **early development**.

The package architecture is being actively developed and the public API may change before the first stable release.

Current focus areas include:

* Meta management
* JSON-LD schema generation
* Automatic model-based SEO
* Automatic model-based structured data
* Additional Schema.org types
* Route-level SEO configuration
* More flexible page detection
* AIO/GEO functionality
* SEO analysis and scoring

Contributions, ideas, bug reports, and architectural feedback are welcome.

---

# License

SeoMunk is open-source software licensed under the [MIT License](LICENSE).
