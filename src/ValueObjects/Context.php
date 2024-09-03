<?php

  declare(strict_types=1);

  namespace UseTheFork\Signal\ValueObjects;

  final class Context {
    private         $bot;
    private Message $message;

    public function __construct($bot, Message $message) {
      $this->bot = $bot;
      $this->message = $message;
    }

    public function send($text, $base64_attachments = null, $mentions = null, $text_mode = null) {
      return $this->bot->send(
        $this->message->recipient(),
        $text,
        [
          'base64_attachments' => $base64_attachments,
          'mentions' => $mentions,
          'text_mode' => $text_mode
        ]
      );
    }

    public function reply($text, $base64_attachments = null, $mentions = null, $text_mode = null) {
      return $this->bot->send(
        $this->message->recipient(),
        $text,
        [
          'base64_attachments' => $base64_attachments,
          'quote_author' => $this->message->source,
          'quote_mentions' => $this->message->mentions,
          'quote_message' => $this->message->text,
          'quote_timestamp' => $this->message->timestamp,
          'mentions' => $mentions,
          'text_mode' => $text_mode
        ]
      );
    }

    public function react($emoji) {
      $this->bot->react($this->message, $emoji);
    }

    public function startTyping() {
      $this->bot->startTyping($this->message->recipient());
    }

    public function stopTyping() {
      $this->bot->stopTyping($this->message->recipient());
    }
  }

