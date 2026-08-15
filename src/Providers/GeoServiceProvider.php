<?php

declare(strict_types=1);

namespace Seomunk\Seomunk\Providers;

use Illuminate\Support\ServiceProvider;
use Seomunk\Seomunk\Console\Commands\SeomunkCommand;

class GeoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->singleton(SchemaBuilder::class);
        // $this->app->singleton(GeoScorer::class);
        // $this->app->singleton(CitationEngine::class);
        // $this->app->singleton(LlmsTxtGenerator::class);
        // $this->app->singleton(ProductFeedGenerator::class);
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
