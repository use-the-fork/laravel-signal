<?php

namespace UseTheFork\Signal\Sdk\Requests\Accounts;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Remove a username.
 *
 * Delete the username associated with this account.
 */
class RemoveUsername extends Request
{
	protected Method $method = Method::DELETE;


	public function resolveEndpoint(): string
	{
		return "/v1/accounts/{$this->number}/username";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
