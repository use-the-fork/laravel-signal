<?php

  use Illuminate\Support\Facades\Http;
  use UseTheFork\Signal\Exceptions\ReceiveMessagesError;
  use UseTheFork\Signal\Exceptions\SendMessageError;
  use UseTheFork\Signal\Services\SignalAPI;
  use UseTheFork\Signal\SignalClient;
  use WebSocket\Client as WebSocketClient;

// Set up the necessary configurations and mocks for PEST tests

  beforeEach(function () {

    $this->signalClient = new SignalClient('+18609902020');
  });

// Test for sending messages using HTTP mock

  test('send message', function () {


//    $receiver = ['group_id1'];
    $receiver = ['+18609907850'];
    $message = 'Hello World!';
    $response = $this->signalClient->send($receiver, $message);

    expect($response->status())->toBe(201);
  });

// Test for receiving messages using WebSocket mock

  test('receive messages', function () {
    // Mocking WebSocket\Client to simulate receiving messages
    $mockClient = Mockery::mock(WebSocketClient::class);
    $mockClient->shouldReceive('receive')
               ->twice()
               ->andReturn(
                 '{"envelope":{"source":"+4901234567890","sourceNumber":"+4901234567890","sourceUuid":"asdf","sourceName":"name","sourceDevice":1,"timestamp":1633169000000,"syncMessage":{"sentMessage":{"timestamp":1633169000000,"message":"Message 1","expiresInSeconds":0,"viewOnce":false,"mentions":[],"attachments":[],"contacts":[],"groupInfo":{"groupId":"group1","type":"DELIVER"},"destination":null,"destinationNumber":null,"destinationUuid":null}}}}',
                 '{"envelope":{"source":"+4901234567890","sourceNumber":"+4901234567890","sourceUuid":"asdf","sourceName":"name","sourceDevice":1,"timestamp":1633169000000,"syncMessage":{"sentMessage":{"timestamp":1633169000000,"message":"Message 2","expiresInSeconds":0,"viewOnce":false,"mentions":[],"attachments":[],"contacts":[],"groupInfo":{"groupId":"group1","type":"DELIVER"},"destination":null,"destinationNumber":null,"destinationUuid":null}}}}'
               );

    // Replacing the WebSocket client in SignalAPI with the mock
    $this->signalApi->setWebSocketClient($mockClient);

    $results = [];
    foreach ($this->signalApi->receive() as $rawMessage) {
      $results[] = $rawMessage;
    }

    expect(count($results))->toBe(2);
    expect($results[0])->toContain('Message 1');
    expect($results[1])->toContain('Message 2');
  });


