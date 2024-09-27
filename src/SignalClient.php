<?php

  declare(strict_types=1);

  namespace UseTheFork\Signal;

use InvalidArgumentException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use UseTheFork\Signal\Exceptions\ApiKeyIsMissing;
use UseTheFork\Signal\Requests\General\ApiHealthCheck;
use UseTheFork\Signal\Requests\Messages\ReceiveSignalMessages;
use UseTheFork\Signal\Requests\Messages\SendSignalMessage;
use UseTheFork\Signal\Requests\Messages\ShowTypingIndicator;

/**
 * Signal Cli REST API
 *
 * This is the Signal Cli REST API documentation.
 */
class SignalClient extends Connector
{

  public function __construct(protected readonly string $signalNumber) {}

  public function resolveBaseUrl(): string
  {
    $apiUrl = config('signal.api_host');
    if(empty($apiUrl)){
      throw new ApiKeyIsMissing();
    }

    return config('signal.api_host');
  }

  public function apiHealthCheck(): int
  {
    return $this->send(new ApiHealthCheck())->status();
  }

  /**
   * Sends a message.
   *
   * @param array       $receivers         The list of receivers for the message.
   * @param string      $message           The content of the message to be sent.
   * @param array       $base64Attachments Optional attachments encoded in base64.
   * @param string|null $quoteAuthor       Optional author of the quoted message.
   * @param array|null  $quoteMentions     Optional mentions in the quoted message.
   * @param string|null $quoteMessage      Optional quoted message content.
   * @param string|null $quoteTimestamp    Optional timestamp of the quoted message.
   * @param array|null  $mentions          Optional mentions in the message.
   * @param string|null $textMode          The mode of the text, either `styled` or `normal`.
   *
   * @return Response The response from the send operation in JSON format.
   * @throws InvalidArgumentException if the text mode is invalid.
   *
   */
  public function sendMessage(
    array $receivers,
    string $message,
    array $base64Attachments = [],
    string|null $quoteAuthor = null,
    array|null $quoteMentions = null,
    string|null $quoteMessage = null,
    string|null $quoteTimestamp = null,
    array|null $mentions = null,
    string|null $textMode = "normal"
  ) : Response
  {
    if (!in_array($textMode, [
      'styled',
      'normal'
    ])) {
      throw new InvalidArgumentException('Invalid text mode must be `styled` or `normal`');
    }

    return $this->send(new SendSignalMessage(
                         signalNumber: $this->signalNumber,
                         receivers: $receivers,
                         message: $message,
                         base64Attachments: $base64Attachments,
                         quoteAuthor: $quoteAuthor,
                         quoteMentions: $quoteMentions,
                         quoteMessage: $quoteMessage,
                         quoteTimestamp: $quoteTimestamp,
                         mentions: $mentions,
                         textMode: $textMode,
                       ));
  }

  public function showTypingIndicator(
    string $recipient,
  ) : Response
  {
    return $this->send(new ShowTypingIndicator(
                         signalNumber: $this->signalNumber,
                         recipient: $recipient,
                       ));
  }

  /**
   * @param null|int          $timeout           Receive timeout in seconds (default: 30)
   * @param null|boolean $ignoreAttachments Specify whether the attachments of the received message should be ignored
   * @param null|boolean $ignoreStories     Specify whether stories should be ignored when receiving messages
   * @param null|int     $maxMessages       Specify the maximum number of messages to receive (default: unlimited)
   * @param null|boolean $sendReadReceipts  Specify whether read receipts should be sent when receiving messages
   *
   * @return array
   * @throws FatalRequestException
   * @throws RequestException
   */
  public function receiveSignalMessages(
    int $timeout = null,
    bool $ignoreAttachments = null,
    bool $ignoreStories = null,
    int $maxMessages = null,
    bool $sendReadReceipts = null,
  ) : array
  {
    return $this->send(new ReceiveSignalMessages(
                         signalNumber: $this->signalNumber,
                         timeout: $timeout,
                         ignoreAttachments: $ignoreAttachments,
                         ignoreStories: $ignoreStories,
                         maxMessages: $maxMessages,
                         sendReadReceipts: $sendReadReceipts,
                       ))->dto();
  }



  protected function defaultHeaders(): array
  {
    return [
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
    ];
  }
}

