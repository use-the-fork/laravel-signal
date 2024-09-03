<?php

namespace UseTheFork\Signal\Sdk\Requests\Groups;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * List a Signal Group.
 *
 * List a specific Signal Group.
 */
class ListSignalGroup extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/groups/{$this->number}/{$this->groupid}";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $groupid Group ID
	 */
	public function __construct(
		protected mixed $number,
		protected mixed $groupid,
	) {
	}
}
