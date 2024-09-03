<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Sdk\Requests\Messages;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Hide Typing Indicator.
 *
 * Hide Typing Indicator.
 */
class HideTypingIndicator extends Request
{
    protected Method $method = Method::DELETE;

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
