<?php

namespace UseTheFork\Signal\Sdk\Requests\Reactions;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Send a reaction.
 *
 * React to a message
 */
class SendReaction extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/reactions/{$this->number}";
	}


	public function __construct()
	{
	}
}
