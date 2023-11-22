<?php

namespace Waad\ZainCash;

use Illuminate\Support\ServiceProvider;

class ZainCashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'zaincash');

        if (!$this->app->runningInConsole()) {
            return;
        }

        // Publish the configuration file
        $this->publishes([
            __DIR__ . '/../config/zaincash.php' => config_path('zaincash.php'),
        ], 'zaincash');

        // Publish the language files
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/zaincash'),
        ], 'zaincash');
    
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('waad-zaincash', function () {
            return new ZainCash();
        });

        $this->app->singleton(\Waad\ZainCash\Helpers\Validations::class);
        $this->app->singleton(\Waad\ZainCash\Helpers\ValidationProcessing::class);
        $this->app->singleton(\Waad\ZainCash\Helpers\ValidationProcessingOtp::class);
        $this->app->singleton(\Waad\ZainCash\Helpers\JWT::class);
        $this->app->singleton(\Waad\ZainCash\Helpers\HttpClient::class);

        $this->mergeConfigFrom(__DIR__ . '/../config/zaincash.php', 'zaincash');
    }
}
