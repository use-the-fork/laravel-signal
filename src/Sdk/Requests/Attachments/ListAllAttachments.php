<?php

namespace UseTheFork\Signal\Sdk\Requests\Attachments;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * List all attachments.
 *
 * List all downloaded attachments
 */
class ListAllAttachments extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/attachments";
	}


	public function __construct()
	{
	}
}
