<?php

namespace UseTheFork\Signal\Sdk\Requests\Accounts;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Set a username.
 *
 * Allows to set the username that should be used for this account. This can either be just the
 * nickname (e.g. test) or the complete username with discriminator (e.g. test.123). Returns the new
 * username with discriminator and the username link.
 */
class SetUsername extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


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
