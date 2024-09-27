<?php

declare(strict_types=1);

namespace Workbench\App\Requests\General;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use UseTheFork\Signal\Requests\Messages\SendSignalMessage;
use UseTheFork\Signal\Requests\Messages\ShowTypingIndicator;
use UseTheFork\Signal\SignalClient;

test('Send Signal Message', function () {

    MockClient::global([
        ShowTypingIndicator::class => MockResponse::fixture('showTypingIndicator-204'),
    ]);

    $signalClient = new SignalClient('18609902020');
    $result = $signalClient->showTypingIndicator('+18609907850');

    expect($result->status())->toBe(204);
});

//  test('Send Signal Message and Receive Error', function () {
//
//    MockClient::global([
//                         SendSignalMessage::class => MockResponse::fixture('sendSignalMessage-400'),
//                       ]);
//
//    $signalClient = new SignalClient();
//    $result = $signalClient->sendMessage(
//      receivers: ["+18887775555"],
//      message: "test message"
//    );
//
//    expect($result->status())->toBe(400)
//                             ->and($result->json('error'))->toContain('Invalid account (phone number), make sure you include the country code.');
//	});
