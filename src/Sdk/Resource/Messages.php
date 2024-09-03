<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Messages\HideTypingIndicator;
use UseTheFork\Signal\Sdk\Requests\Messages\ReceiveSignalMessages;
use UseTheFork\Signal\Sdk\Requests\Messages\SendSignalMessage;
use UseTheFork\Signal\Sdk\Requests\Messages\ShowTypingIndicator;
use UseTheFork\Signal\Sdk\Resource;

class Messages extends Resource
{
    /**
     * @param  mixed  $number  Registered Phone Number
     * @param  mixed  $timeout  Receive timeout in seconds (default: 1)
     * @param  mixed  $ignoreAttachments  Specify whether the attachments of the received message should be ignored
     * @param  mixed  $ignoreStories  Specify whether stories should be ignored when receiving messages
     * @param  mixed  $maxMessages  Specify the maximum number of messages to receive (default: unlimited)
     * @param  mixed  $sendReadReceipts  Specify whether read receipts should be sent when receiving messages
     */
    public function receiveSignalMessages(
        mixed $number,
        mixed $timeout,
        mixed $ignoreAttachments,
        mixed $ignoreStories,
        mixed $maxMessages,
        mixed $sendReadReceipts,
    ): Response {
        return $this->connector->send(new ReceiveSignalMessages($number, $timeout, $ignoreAttachments, $ignoreStories, $maxMessages, $sendReadReceipts));
    }

    public function sendSignalMessage(): Response
    {
        return $this->connector->send(new SendSignalMessage());
    }

    /**
     * @param  mixed  $number  Registered Phone Number
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function showTypingIndicator(mixed $number): Response
    {
        return $this->connector->send(new ShowTypingIndicator($number));
    }

    /**
     * @param  mixed  $number  Registered Phone Number
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function hideTypingIndicator(mixed $number): Response
    {
        return $this->connector->send(new HideTypingIndicator($number));
    }

    /**
     * @todo Fix duplicated method name
     */
    public function sendSignalMessageDuplicate1(): Response
    {
        return $this->connector->send(new SendSignalMessage());
    }
}
