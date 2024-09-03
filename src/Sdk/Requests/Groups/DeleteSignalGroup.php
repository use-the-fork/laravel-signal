<?php

namespace UseTheFork\Signal\Sdk\Requests\Groups;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a Signal Group.
 *
 * Delete the specified Signal Group.
 */
class DeleteSignalGroup extends Request
{
	protected Method $method = Method::DELETE;


	public function resolveEndpoint(): string
	{
		return "/v1/groups/{$this->number}/{$this->groupid}";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $groupid Group Id
	 */
	public function __construct(
		protected mixed $number,
		protected mixed $groupid,
	) {
	}
}
