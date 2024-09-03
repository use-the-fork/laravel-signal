<?php

  declare(strict_types=1);

  namespace UseTheFork\Signal\Services;

  use Illuminate\Support\Facades\Http;
  use Exception;
  use UseTheFork\Signal\Exceptions\GroupsError;
  use UseTheFork\Signal\Exceptions\ReactionError;
  use UseTheFork\Signal\Exceptions\ReceiveMessagesError;
  use UseTheFork\Signal\Exceptions\SendMessageError;
  use UseTheFork\Signal\Exceptions\StartTypingError;
  use UseTheFork\Signal\Exceptions\StopTypingError;

  class SignalAPI
  {
    private string $signalProtocol;
    private string $signalService;
    private string $phoneNumber;

    public function __construct(string $phoneNumber)
    {
      $this->signalProtocol = config('signal.api_protocol');
      $this->signalService = config('signal.api_host');
      $this->phoneNumber = $phoneNumber;
    }

    /**
     * @throws ReceiveMessagesError
     */
    public function receive()
    {
      try {
        $uri = $this->getReceiveWsUri();
        $connection = new \WebSocket\Client($uri);

        while ($rawMessage = $connection->receive()) {
          yield $rawMessage;
        }
      } catch (Exception $e) {
        throw new ReceiveMessagesError($e->getMessage());
      }
    }

    /**
     * @throws SendMessageError
     */
    public function send(
      string $receiver,
      string $message,
      array $base64Attachments = [],
      ?string $quoteAuthor = null,
      ?array $quoteMentions = null,
      ?string $quoteMessage = null,
      ?string $quoteTimestamp = null,
      ?array $mentions = null,
      ?string $textMode = null
    ) {
      $uri = $this->getSendRestUri();

      $payload = [
        'base64_attachments' => $base64Attachments,
        'message' => $message,
        'number' => $this->phoneNumber,
        'recipients' => [$receiver],
      ];

      if ($quoteAuthor) {
        $payload['quote_author'] = $quoteAuthor;
      }
      if ($quoteMentions) {
        $payload['quote_mentions'] = $quoteMentions;
      }
      if ($quoteMessage) {
        $payload['quote_message'] = $quoteMessage;
      }
      if ($quoteTimestamp) {
        $payload['quote_timestamp'] = $quoteTimestamp;
      }
      if ($mentions) {
        $payload['mentions'] = $mentions;
      }
      if ($textMode) {
        $payload['text_mode'] = $textMode;
      }

      try {
        $response = Http::post($uri, $payload);

        if ($response->failed()) {
          throw new SendMessageError('Failed to send message');
        }

        return $response;
      } catch (Exception $e) {
        throw new SendMessageError($e->getMessage());
      }
    }

    /**
     * @throws ReactionError
     */
    public function react(string $recipient, string $reaction, string $targetAuthor, int $timestamp)
    {
      $uri = $this->getReactRestUri();
      $payload = [
        'recipient' => $recipient,
        'reaction' => $reaction,
        'target_author' => $targetAuthor,
        'timestamp' => $timestamp,
      ];

      try {
        $response = Http::post($uri, $payload);

        if ($response->failed()) {
          throw new ReactionError('Failed to react');
        }

        return $response;
      } catch (Exception $e) {
        throw new ReactionError($e->getMessage());
      }
    }

    /**
     * @throws StartTypingError
     */
    public function startTyping(string $receiver)
    {
      $uri = $this->getTypingIndicatorUri();
      $payload = [
        'recipient' => $receiver,
      ];

      try {
        $response = Http::put($uri, $payload);

        if ($response->failed()) {
          throw new StartTypingError('Failed to start typing');
        }

        return $response;
      } catch (Exception $e) {
        throw new StartTypingError($e->getMessage());
      }
    }

    /**
     * @throws StopTypingError
     */
    public function stopTyping(string $receiver)
    {
      $uri = $this->getTypingIndicatorUri();
      $payload = [
        'recipient' => $receiver,
      ];

      try {
        $response = Http::delete($uri, $payload);

        if ($response->failed()) {
          throw new StopTypingError('Failed to stop typing');
        }

        return $response;
      } catch (Exception $e) {
        throw new StopTypingError($e->getMessage());
      }
    }

    /**
     * @throws GroupsError
     */
    public function getGroups()
    {
      $uri = $this->getGroupsUri();

      try {
        $response = Http::get($uri);

        if ($response->failed()) {
          throw new GroupsError('Failed to fetch groups');
        }

        return $response->json();
      } catch (Exception $e) {
        throw new GroupsError($e->getMessage());
      }
    }

    private function getReceiveWsUri(): string
    {
      return sprintf('ws://%s/v1/receive/%s', $this->signalService, $this->phoneNumber);
    }

    private function getSendRestUri(): string
    {
      return sprintf('%s://%s/v2/send', $this->signalProtocol, $this->signalService);
    }

    private function getReactRestUri(): string
    {
      return sprintf('%s://%s/v1/reactions/%s', $this->signalProtocol, $this->signalService, $this->phoneNumber);
    }

    private function getTypingIndicatorUri(): string
    {
      return sprintf('%s://%s/v1/typing-indicator/%s', $this->signalProtocol, $this->signalService, $this->phoneNumber);
    }

    private function getGroupsUri(): string
    {
      return sprintf('%s://%s/v1/groups/%s', $this->signalProtocol, $this->signalService, $this->phoneNumber);
    }
  }
