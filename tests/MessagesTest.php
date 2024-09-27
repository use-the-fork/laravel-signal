<?php

	namespace Workbench\App\Requests\General;

	use Saloon\Http\Faking\MockClient;
  use Saloon\Http\Faking\MockResponse;
  use UseTheFork\Signal\Requests\Messages\SendSignalMessage;
  use UseTheFork\Signal\SignalClient;

  test('Send Signal Message', function () {

    MockClient::global([
                         SendSignalMessage::class => MockResponse::fixture('sendSignalMessage-201'),
                       ]);

    $signalClient = new SignalClient('+18887776666');
    $result = $signalClient->sendMessage(
      receivers  : ['+18887775555'],
      message: "test message"
    );

    expect($result->status())->toBe(201);
	});

  test('Send Signal Message and Receive Error', function () {

    MockClient::global([
                         SendSignalMessage::class => MockResponse::fixture('sendSignalMessage-400'),
                       ]);

    $signalClient = new SignalClient('+1888777666666');
    $result = $signalClient->sendMessage(
      receivers: ["+18887775555"],
      message: "test message"
    );

    expect($result->status())->toBe(400)
                             ->and($result->json('error'))->toContain('Invalid account (phone number), make sure you include the country code.');
	});
