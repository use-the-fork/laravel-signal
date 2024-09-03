<?php

namespace UseTheFork\Signal\Sdk\Requests\Contacts;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Send a synchronization message with the local contacts list to all linked devices.
 *
 * Send a synchronization message with the local contacts list to all linked devices. This command
 * should only be used if this is the primary device.
 */
class SendSynchronizationMessageWithTheLocalContactsListToAllLinkedDevices extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/contacts/{$this->number}/sync";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
