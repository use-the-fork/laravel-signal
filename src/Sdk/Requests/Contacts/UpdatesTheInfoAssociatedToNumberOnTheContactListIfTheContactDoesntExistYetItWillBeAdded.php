<?php

namespace UseTheFork\Signal\Sdk\Requests\Contacts;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Updates the info associated to a number on the contact list. If the contact doesn’t exist yet, it will be added.
 *
 * Updates the info associated to a number on the contact list.
 */
class UpdatesTheInfoAssociatedToNumberOnTheContactListIfTheContactDoesntExistYetItWillBeAdded extends Request
{
	protected Method $method = Method::PUT;


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
