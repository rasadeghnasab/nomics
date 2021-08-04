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
        // translation
        // facade

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
//        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'courier');
    }
}
