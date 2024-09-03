<?php

namespace UseTheFork\Signal\Sdk\Requests\Devices;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Verify a registered phone number.
 *
 * Verify a registered phone number with the signal network.
 */
class VerifyRegisteredPhoneNumber extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/register/{$this->number}/verify/{$this->token}";
	}


	/**
	 * @param string $number Registered Phone Number
	 * @param string $token Verification Code
	 */
	public function __construct(
		protected string $number,
		protected string $token,
	) {
	}
}
