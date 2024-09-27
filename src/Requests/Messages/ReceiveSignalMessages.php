<?php

namespace UseTheFork\Signal\Requests\Messages;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Receive Signal Messages.
 *
 * Receives Signal Messages from the Signal Network.
 */
class ReceiveSignalMessages extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/receive/{$this->signalNumber}";
	}

  public function createDtoFromResponse(Response $response): array
  {
    $data = $response->body();
    return json_decode(str($data)->beforeLast(',SLF4J(I)')->append(']')->toString(), true);
  }

	/**
	 * @param string $signalNumber Registered Phone Number
	 * @param null|int $timeout Receive timeout in seconds (default: 1)
	 * @param null|boolean $ignoreAttachments Specify whether the attachments of the received message should be ignored
	 * @param null|boolean $ignoreStories Specify whether stories should be ignored when receiving messages
	 * @param null|int $maxMessages Specify the maximum number of messages to receive (default: unlimited)
	 * @param null|boolean $sendReadReceipts Specify whether read receipts should be sent when receiving messages
	 */
	public function __construct(
		protected string $signalNumber,
		protected int|null $timeout = null,
		protected null|bool $ignoreAttachments = null,
		protected null|bool $ignoreStories = null,
		protected null|int $maxMessages = null,
		protected null|bool $sendReadReceipts = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter([
			'timeout' => $this->timeout,
			'ignore_attachments' => $this->ignoreAttachments ? 'true' : 'false',
			'ignore_stories' => $this->ignoreStories ? 'true' : 'false',
			'max_messages' => $this->maxMessages,
			'send_read_receipts' => $this->sendReadReceipts ? 'true' : 'false',
		]);
	}
}
