<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Requests\Reactions;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Remove a reaction.
 *
 * Remove a reaction
 */
class RemoveReaction extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/v1/reactions/{$this->number}";
    }

    public function __construct() {}
}
