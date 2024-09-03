<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Sdk\Requests\Groups;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Quit a Signal Group.
 *
 * Quit the specified Signal Group.
 */
class QuitSignalGroup extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/v1/groups/{$this->number}/{$this->groupid}/quit";
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
