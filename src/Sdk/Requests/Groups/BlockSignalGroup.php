<?php

namespace UseTheFork\Signal\Sdk\Requests\Groups;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Block a Signal Group.
 *
 * Block the specified Signal Group.
 */
class BlockSignalGroup extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/groups/{$this->number}/{$this->groupid}/block";
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
