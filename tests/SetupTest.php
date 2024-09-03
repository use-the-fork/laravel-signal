<?php

  use Illuminate\Support\Facades\Http;
  use UseTheFork\Signal\Exceptions\ReceiveMessagesError;
  use UseTheFork\Signal\Exceptions\SendMessageError;
  use UseTheFork\Signal\Services\SignalAPI;
  use WebSocket\Client as WebSocketClient;

  test('Menu', function () {
    $this->artisan('signal:setup')
         ->expectsQuestion('What is your name?', 'Taylor Otwell');
  });
