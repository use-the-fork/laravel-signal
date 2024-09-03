<?php

namespace UseTheFork\Signal\Sdk\Requests\General;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Set the REST API configuration.
 *
 * Set the REST API configuration.
 */
class SetTheRestApiConfiguration extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/configuration";
	}


	public function __construct()
	{
	}
}
