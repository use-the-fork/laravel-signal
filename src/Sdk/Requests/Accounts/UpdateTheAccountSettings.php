<?php

namespace UseTheFork\Signal\Sdk\Requests\Accounts;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Update the account settings.
 *
 * Update the account attributes on the signal server.
 */
class UpdateTheAccountSettings extends Request
{
	protected Method $method = Method::PUT;


	public function resolveEndpoint(): string
	{
		return "/v1/accounts/{$this->number}/settings";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
