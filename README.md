<p align="center"><a href="https://pubplus.net" target="_blank"><img src="https://pubplus-portal-v1.s3.us-east-2.amazonaws.com/customer-logos/15/01KBG38D3PF26H66F6PBAMPQ97.svg" width="400" alt="Publications Plus Logo"></a><br><sub>Powered by Publications Plus</sub></p>


# SeoMunk

SeoMunk is an open-source Laravel package for SEO and AI Search Optimization (AIO/GEO).

SeoMunk provides a flexible, Laravel-native API for managing:

* SEO meta tags
* Open Graph metadata
* Twitter/X metadata
* Canonical URLs
* Robots directives
* JSON-LD structured data
* Automatic metadata and schema generation from Eloquent models
* Manually defined metadata and schemas
* FAQ, Product, Review, Breadcrumb, Organization, and other Schema.org types
* Raw JSON-LD schemas

> **Current status:** Early development. The API is actively evolving and should not yet be considered stable.

---

## Installation

Install SeoMunk through Composer:

```bash
composer require jon-mierke/seomunk
```

Publish the configuration:

```bash
php artisan vendor:publish --tag=seomunk-config
```

---