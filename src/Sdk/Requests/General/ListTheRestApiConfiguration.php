<?php

namespace UseTheFork\Signal\Sdk\Requests\General;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * List the REST API configuration.
 *
 * List the REST API configuration.
 */
class ListTheRestApiConfiguration extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/configuration";
	}


	public function __construct()
	{
	}
}
