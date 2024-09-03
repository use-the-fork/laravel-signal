<?php

namespace UseTheFork\Signal\Sdk\Requests\Attachments;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Serve Attachment.
 *
 * Serve the attachment with the given id
 */
class ServeAttachment extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/attachments/{$this->attachment}";
	}


	/**
	 * @param mixed $attachment Attachment ID
	 */
	public function __construct(
		protected mixed $attachment,
	) {
	}
}
