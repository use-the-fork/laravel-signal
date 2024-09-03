<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Attachments\ListAllAttachments;
use UseTheFork\Signal\Sdk\Requests\Attachments\RemoveAttachment;
use UseTheFork\Signal\Sdk\Requests\Attachments\ServeAttachment;
use UseTheFork\Signal\Sdk\Resource;

class Attachments extends Resource
{
	public function listAllAttachments(): Response
	{
		return $this->connector->send(new ListAllAttachments());
	}


	/**
	 * @param mixed $attachment Attachment ID
	 */
	public function serveAttachment(mixed $attachment): Response
	{
		return $this->connector->send(new ServeAttachment($attachment));
	}


	/**
	 * @param mixed $attachment Attachment ID
	 */
	public function removeAttachment(mixed $attachment): Response
	{
		return $this->connector->send(new RemoveAttachment($attachment));
	}
}
