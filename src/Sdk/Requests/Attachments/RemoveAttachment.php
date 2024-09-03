<?php

namespace UseTheFork\Signal\Sdk\Requests\Attachments;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Remove attachment.
 *
 * Remove the attachment with the given id from filesystem.
 */
class RemoveAttachment extends Request
{
	protected Method $method = Method::DELETE;


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
