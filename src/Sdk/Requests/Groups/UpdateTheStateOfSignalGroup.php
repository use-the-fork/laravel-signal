<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Sdk\Requests\Groups;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Update the state of a Signal Group.
 *
 * Update the state of a Signal Group.
 */
class UpdateTheStateOfSignalGroup extends Request
{
    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return "/v1/groups/{$this->number}/{$this->groupid}";
    }

    /**
     * @param  mixed  $number  Registered Phone Number
     * @param  mixed  $groupid  Group ID
     */
    public function __construct(
        protected mixed $number,
        protected mixed $groupid,
    ) {}
}
