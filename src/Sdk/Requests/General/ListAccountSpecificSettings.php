<?php

namespace UseTheFork\Signal\Sdk\Requests\General;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * List account specific settings.
 *
 * List account specific settings.
 */
class ListAccountSpecificSettings extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/configuration/{$this->number}/settings";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
