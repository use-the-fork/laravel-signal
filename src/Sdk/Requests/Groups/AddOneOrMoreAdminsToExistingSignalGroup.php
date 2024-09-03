<?php

namespace UseTheFork\Signal\Sdk\Requests\Groups;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Add one or more admins to an existing Signal Group.
 *
 * Add one or more admins to an existing Signal Group.
 */
class AddOneOrMoreAdminsToExistingSignalGroup extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


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
