<?php

namespace UseTheFork\Signal\Sdk\Requests\General;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Set account specific settings.
 *
 * Set account specific settings.
 */
class SetAccountSpecificSettings extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/configuration/{$this->number}/settings";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
