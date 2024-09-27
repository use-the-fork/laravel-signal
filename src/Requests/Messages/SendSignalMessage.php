<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Requests\Messages;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Send a signal message.
 */
class SendSignalMessage extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/v2/send';
    }

    protected function defaultBody(): array
    {

        $payload = [
            'base64_attachments' => $this->base64Attachments,
            'message' => $this->message,
            'number' => $this->signalNumber,
            'recipients' => $this->receivers,
        ];

        if ($this->quoteAuthor) {
            $payload['quote_author'] = $this->quoteAuthor;
        }
        if ($this->quoteMentions) {
            $payload['quote_mentions'] = $this->quoteMentions;
        }
        if ($this->quoteMessage) {
            $payload['quote_message'] = $this->quoteMessage;
        }
        if ($this->quoteTimestamp) {
            $payload['quote_timestamp'] = $this->quoteTimestamp;
        }
        if ($this->mentions) {
            $payload['mentions'] = $this->mentions;
        }
        if ($this->textMode) {
            $payload['text_mode'] = $this->textMode;
        }

        return $payload;
    }

    public function __construct(
        public string $signalNumber,
        public array $receivers,
        public string $message,
        public array $base64Attachments = [],
        public ?string $quoteAuthor = null,
        public ?array $quoteMentions = null,
        public ?string $quoteMessage = null,
        public ?string $quoteTimestamp = null,
        public ?array $mentions = null,
        public ?string $textMode = null
    ) {}
}
