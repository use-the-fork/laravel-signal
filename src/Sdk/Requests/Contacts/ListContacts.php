<?php

namespace UseTheFork\Signal\Sdk\Requests\Contacts;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * List Contacts
 *
 * List all contacts for the given number.
 */
class ListContacts extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/contacts/{$this->number}";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
