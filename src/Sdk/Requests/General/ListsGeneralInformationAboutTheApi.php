<?php

namespace UseTheFork\Signal\Sdk\Requests\General;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Lists general information about the API
 *
 * Returns the supported API versions and the internal build nr
 */
class ListsGeneralInformationAboutTheApi extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/about";
	}


	public function __construct()
	{
	}
}
