<?php

namespace UseTheFork\Signal\Sdk\Requests\Groups;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Remove one or more admins from an existing Signal Group.
 *
 * Remove one or more admins from an existing Signal Group.
 */
class RemoveOneOrMoreAdminsFromExistingSignalGroup extends Request
{
	protected Method $method = Method::DELETE;


	public function resolveEndpoint(): string
	{
		return "/v1/groups/{$this->number}/{$this->groupid}/admins";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
