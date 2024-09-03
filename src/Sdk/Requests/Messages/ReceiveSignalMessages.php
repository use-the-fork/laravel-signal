<?php

namespace UseTheFork\Signal\Sdk\Requests\Messages;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Receive Signal Messages.
 *
 * Receives Signal Messages from the Signal Network. If you are running the docker container in
 * normal/native mode, this is a GET endpoint. In json-rpc mode this is a websocket endpoint.
 */
class ReceiveSignalMessages extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/receive/{$this->number}";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param null|mixed $timeout Receive timeout in seconds (default: 1)
	 * @param null|mixed $ignoreAttachments Specify whether the attachments of the received message should be ignored
	 * @param null|mixed $ignoreStories Specify whether stories should be ignored when receiving messages
	 * @param null|mixed $maxMessages Specify the maximum number of messages to receive (default: unlimited)
	 * @param null|mixed $sendReadReceipts Specify whether read receipts should be sent when receiving messages
	 */
	public function __construct(
		protected mixed $number,
		protected mixed $timeout = null,
		protected mixed $ignoreAttachments = null,
		protected mixed $ignoreStories = null,
		protected mixed $maxMessages = null,
		protected mixed $sendReadReceipts = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter([
			'timeout' => $this->timeout,
			'ignore_attachments' => $this->ignoreAttachments,
			'ignore_stories' => $this->ignoreStories,
			'max_messages' => $this->maxMessages,
			'send_read_receipts' => $this->sendReadReceipts,
		]);
	}
}
