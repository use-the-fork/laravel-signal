<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Tests;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as Orchestra;
use UseTheFork\Signal\SignalServiceProvider;
use Workbench\Database\Seeders\DatabaseSeeder;

use function Orchestra\Testbench\workbench_path;

class TestCase extends Orchestra
{
    use WithWorkbench;

    protected function getPackageProviders($app): array
    {
        return [
          SignalServiceProvider::class,
        ];
    }

  protected function getEnvironmentSetUp($app): void
  {
    // make sure, our .env file is loaded
    $app->useEnvironmentPath(__DIR__.'/..');
    $app->bootstrapWith([LoadEnvironmentVariables::class]);

    tap($app['config'], function (Repository $config) {
      $config->set('signal', [
        'api_protocol' => env('SIGNAL_API_PROTOCOL', 'https'),
        'api_host' => env('SIGNAL_API_HOST'),
        'request_timeout' => env('SIGNAL_REQUEST_TIMEOUT', 30),
      ]);
    });

    parent::getEnvironmentSetUp($app);
  }

}
