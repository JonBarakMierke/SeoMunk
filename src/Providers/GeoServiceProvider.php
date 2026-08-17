<?php

declare(strict_types=1);

namespace SeoMunk\SeoMunk\Providers;

use Illuminate\Support\ServiceProvider;
use SeoMunk\SeoMunk\Console\Commands\SeomunkCommand;
use SeoMunk\SeoMunk\Modules\JSON\Schema\BuildAutomaticSchema;
use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaBuilder;
use SeoMunk\SeoMunk\Modules\JSON\Schema\SchemaManager;

class GeoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SchemaManager::class);

        $this->app->singleton(
            SchemaBuilder::class,
            fn ($app) => new SchemaBuilder(
                $app->make(SchemaManager::class)
            )
        );

        $this->app->singleton(BuildAutomaticSchema::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../../config/seo-munk-geo.php' => config_path('seo-munk-geo.php'),
        ], 'seo-munk-geo-config');
    }
}
