<?php

namespace UseTheFork\Signal\Sdk\Requests\Messages;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Send a signal message.
 *
 * Send a signal message
 */
class SendSignalMessage extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/send";
	}


	public function __construct()
	{
	}
}
