<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Sdk\Requests\Groups;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Remove one or more members from an existing Signal Group.
 *
 * Remove one or more members from an existing Signal Group.
 */
class RemoveOneOrMoreMembersFromExistingSignalGroup extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/v1/groups/{$this->number}/{$this->groupid}/members";
    }

    /**
     * @param  mixed  $number  Registered Phone Number
     */
    public function __construct(
        protected mixed $number,
    ) {}
}
