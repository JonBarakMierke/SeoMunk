<?php

declare(strict_types=1);

namespace SeoMunk\SeoMunk;

use Illuminate\Support\ServiceProvider;
use SeoMunk\SeoMunk\Console\Commands\SeomunkCommand;
use SeoMunk\SeoMunk\Providers\GeoServiceProvider;
use SeoMunk\SeoMunk\Providers\MetaServiceProvider;
use SeoMunk\SeoMunk\View\Components\JsonHead;

class SeoMunkServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/seomunk.php', 'seomunk');

        $this->app->singleton(SeoMunk::class);

        /**
         * Register Modules
         */
        $this->app->register(GeoServiceProvider::class);
        $this->app->register(MetaServiceProvider::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['blade.compiler']->component('json-head', JsonHead::class);

        $this->loadRoutesFrom(__DIR__.'/../routes/seomunk.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'seomunk');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'seomunk');

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/seomunk.php' => config_path('seomunk.php'),
        ], ['seomunk', 'seomunk-config']);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/seomunk'),
        ], ['seomunk', 'seomunk-views']);

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/seomunk'),
        ], ['seomunk', 'seomunk-lang']);

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/seomunk'),
        ], ['seomunk', 'seomunk-assets']);

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], ['seomunk', 'seomunk-migrations']);

        $this->commands([
            SeoMunkCommand::class,
        ]);
    }
}
