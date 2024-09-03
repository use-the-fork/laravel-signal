<?php

declare(strict_types=1);

return [

    /*
  |--------------------------------------------------------------------------
  | Signal API Host
  |--------------------------------------------------------------------------
  |
  | Here you may specify your Signal API Host. This will be used to send
  | requests to signal and receive messages.
  | You will need to set up and run https://github.com/bbernhard/signal-cli-rest-api
  | for this to work
  */

    'api_host' => env('SIGNAL_API_HOST', 'https://signal.onigiri.isdelicio.us'),

    /*
  |--------------------------------------------------------------------------
  | Request Timeout
  |--------------------------------------------------------------------------
  |
  | The timeout may be used to specify the maximum number of seconds to wait
  | for a response. By default, the client will time out after 30 seconds.
  */

    'request_timeout' => env('SIGNAL_REQUEST_TIMEOUT', 30),
];
