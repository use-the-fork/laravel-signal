<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Requests\Messages;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Show Typing Indicator.
 *
 */
class ShowTypingIndicator extends Request
{
    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return "/v1/typing-indicator/{$this->signalNumber}";
    }


  protected function defaultBody(): array
  {
    return [
      'recipient' => $this->recipient
    ];
  }

    /**
     * @param  string  $signalNumber  Registered Phone Number
     * @param  string  $recipient  Recipient that should see the typing indicator
     */
    public function __construct(
        protected string $signalNumber,
        protected string $recipient,
    ) {}
}
