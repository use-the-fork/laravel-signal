<?php

declare(strict_types=1);

namespace Workbench\App\Requests\General;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use UseTheFork\Signal\Requests\Messages\ReceiveSignalMessages;
use UseTheFork\Signal\SignalClient;

test('Receive Signal Messages', function () {

    MockClient::global([
        ReceiveSignalMessages::class => MockResponse::fixture('receiveSignalMessages-200'),
    ]);

    $signalClient = new SignalClient('+18609902020');
    $result = $signalClient->receiveSignalMessages(sendReadReceipts: true);

    expect($result)->toBe(200);
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
