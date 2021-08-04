<?php

namespace App\Services\Nomics;

use Illuminate\Support\ServiceProvider;

class NomicsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // config file
        $this->mergeConfigFrom(
            __DIR__ . '/config/nomics.php', 'nomics'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // facade
        $this->app->bind('nomics', function()
        {
            return new NomicsAPI;
        });

        // translation
//        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'nomics');
    }
}
