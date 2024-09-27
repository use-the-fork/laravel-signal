<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Requests\Search;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Check if one or more phone numbers are registered with the Signal Service.
 *
 * Check if one or more phone numbers are registered with the Signal Service.
 */
class CheckIfOneOrMorePhoneNumbersAreRegisteredWithTheSignalService extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1/search';
    }

    /**
     * @param  null|mixed  $number  Registered Phone Number
     * @param  mixed  $numbers  Numbers to check
     */
    public function __construct(
        protected mixed $number = null,
        protected mixed $numbers,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['numbers' => $this->numbers]);
    }
}
