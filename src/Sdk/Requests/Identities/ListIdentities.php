<?php

namespace UseTheFork\Signal\Sdk\Requests\Identities;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * List Identities
 *
 * List all identities for the given number.
 */
class ListIdentities extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/identities/{$this->number}";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
