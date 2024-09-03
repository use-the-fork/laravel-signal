<?php

namespace UseTheFork\Signal\Sdk\Requests\Devices;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Unregister a phone number.
 *
 * Disables push support for this device. **WARNING:** If *delete_account* is set to *true*, the
 * account will be deleted from the Signal Server. This cannot be undone without loss.
 */
class UnregisterPhoneNumber extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/unregister/{$this->number}";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
