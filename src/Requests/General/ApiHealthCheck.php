<?php

namespace UseTheFork\Signal\Requests\General;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * API Health Check
 *
 * Internally used by the docker container to perform the health check.
 */
class ApiHealthCheck extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/health";
	}

	public function __construct()
	{
	}
}
