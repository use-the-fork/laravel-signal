<?php

declare(strict_types=1);

namespace UseTheFork\Signal;

use Illuminate\Support\ServiceProvider;

class SignalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot(): void
    {

        $this->publishes([
            __DIR__.'/../config/signal.php' => config_path('signal.php'),
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/signal.php', 'signal'
        );

    }
}
