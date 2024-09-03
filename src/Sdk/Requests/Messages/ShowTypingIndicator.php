<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Sdk\Requests\Messages;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Show Typing Indicator.
 *
 * Show Typing Indicator.
 */
class ShowTypingIndicator extends Request
{
    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return "/v1/typing-indicator/{$this->number}";
    }

    /**
     * @param  mixed  $number  Registered Phone Number
     */
    public function __construct(
        protected mixed $number,
    ) {}
}
