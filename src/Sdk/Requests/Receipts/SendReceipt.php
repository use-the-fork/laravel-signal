<?php

namespace UseTheFork\Signal\Sdk\Requests\Receipts;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Send a receipt.
 *
 * Send a read or viewed receipt
 */
class SendReceipt extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/receipts/{$this->number}";
	}


	public function __construct()
	{
	}
}
