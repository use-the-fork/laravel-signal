<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Sdk\Requests\Identities;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Trust Identity
 *
 * Trust an identity. When 'trust_all_known_keys' is set to' true', all known keys of this user are
 * trusted. **This is only recommended for testing.**
 */
class TrustIdentity extends Request
{
    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return "/v1/identities/{$this->number}/trust/{$this->numberToTrust}";
    }

    /**
     * @param  mixed  $number  Registered Phone Number
     * @param  mixed  $numberToTrust  Number To Trust
     */
    public function __construct(
        protected mixed $number,
        protected mixed $numberToTrust,
    ) {}
}
