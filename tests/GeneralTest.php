<?php

declare(strict_types=1);

namespace Workbench\App\Requests\General;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use UseTheFork\Signal\Requests\General\ApiHealthCheck;
use UseTheFork\Signal\SignalClient;

test('Api Health Check Test', function () {

    MockClient::global([
        ApiHealthCheck::class => MockResponse::fixture('apiHealthCheck'),
    ]);

    $signalClient = new SignalClient();
    $result = $signalClient->apiHealthCheck();
    expect($result)->toBe(204);
});
