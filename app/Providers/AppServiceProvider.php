<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Skip database auto-alignment during console/artisan commands
        if ($this->app->runningInConsole()) {
            return;
        }

        // Auto align database schema in web runtime if tables differ
        try {
            $lockPath = storage_path('framework/schema_aligned_v3.lock');
            if (!file_exists($lockPath)) {
                @unlink(storage_path('framework/schema_aligned_v2.lock'));
                \App\Support\DatabaseSchemaAligner::align();
                @file_put_contents($lockPath, date('Y-m-d H:i:s'));
            }
        } catch (\Throwable $e) {
            // Fail safely if database is offline or during installation
        }
    }
}
