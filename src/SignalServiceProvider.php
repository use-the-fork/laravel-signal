<?php

declare(strict_types=1);

namespace UseTheFork\Signal;

use Illuminate\Support\ServiceProvider;
use UseTheFork\Signal\Console\Setup;
use UseTheFork\Signal\Contracts\ClientContract;
use UseTheFork\Signal\Exceptions\ApiKeyIsMissing;

class SignalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot(): void
    {

      $this->commands([
                        Setup::class
                      ]);

      $this->publishes([
                         __DIR__.'/../config/signal.php' => config_path('signal.php'),
                       ]);

      $this->app->singleton(ClientContract::class, static function () {
        $apiKey = config('openai.api_key');
        $organization = config('openai.organization');

        if (! is_string($apiKey) || ($organization !== null && ! is_string($organization))) {
          throw ApiKeyIsMissing::create();
        }

//        return OpenAI::factory()
//                     ->withApiKey($apiKey)
//                     ->withOrganization($organization)
//                     ->withHttpHeader('OpenAI-Beta', 'assistants=v2')
//                     ->withHttpClient(new \GuzzleHttp\Client(['timeout' => config('openai.request_timeout', 30)]))
//                     ->make();
      });
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
