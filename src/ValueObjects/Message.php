<?php

declare(strict_types=1);

namespace UseTheFork\Signal\ValueObjects;

use Exception;
use Stringable;
use UseTheFork\Signal\Exceptions\UnknownMessageFormatError;

final class Message implements Stringable
{
    public $source;

    public $source_number;

    public $source_uuid;

    public $timestamp;

    public $type;

    public $text;

    public $base64_attachments;

    public $group;

    public $reaction;

    public $mentions;

    public $raw_message;

    public function __construct(
        $source,
        $source_number,
        $source_uuid,
        $timestamp,
        $type,
        $text,
        $base64_attachments = null,
        $group = null,
        $reaction = null,
        $mentions = null,
        $raw_message = null
    ) {
        // required
        $this->source = $source;
        $this->source_number = $source_number;
        $this->source_uuid = $source_uuid;
        $this->timestamp = $timestamp;
        $this->type = $type;
        $this->text = $text;

        // optional
        $this->base64_attachments = $base64_attachments ?? [];
        $this->group = $group;
        $this->reaction = $reaction;
        $this->mentions = $mentions ?? [];
        $this->raw_message = $raw_message;
    }

    public function recipient()
    {
        // Case 1: Group chat
        if ($this->group) {
            return $this->group; // internal ID
        }

        // Case 2: User chat
        return $this->source;
    }

    public function isPrivate(): bool
    {
        return ! $this->group;
    }

    public function isGroup(): bool
    {
        return (bool) $this->group;
    }

    /**
     * @throws UnknownMessageFormatError
     */
    public static function parse($raw_message): Message
    {
        try {
            $raw_message = json_decode($raw_message, true);
        } catch (Exception $e) {
            throw new UnknownMessageFormatError($e->getMessage());
        }

        // General attributes
        try {
            $source = $raw_message['envelope']['source'];
            $source_uuid = $raw_message['envelope']['sourceUuid'];
            $timestamp = $raw_message['envelope']['timestamp'];
        } catch (Exception $e) {
            throw new UnknownMessageFormatError();
        }

        $source_number = $raw_message['envelope']['sourceNumber'] ?? null;

        // Option 1: syncMessage
        if (isset($raw_message['envelope']['syncMessage'])) {
            $type = MessageType::SYNC_MESSAGE;
            $text = self::parseSyncMessage($raw_message['envelope']['syncMessage']);
            $group = self::parseGroupInformation($raw_message['envelope']['syncMessage']['sentMessage']);
            $reaction = self::parseReaction($raw_message['envelope']['syncMessage']['sentMessage']);
            $mentions = self::parseMentions($raw_message['envelope']['syncMessage']['sentMessage']);

            // Option 2: dataMessage
        } elseif (isset($raw_message['envelope']['dataMessage'])) {
            $type = MessageType::DATA_MESSAGE;
            $text = self::parseDataMessage($raw_message['envelope']['dataMessage']);
            $group = self::parseGroupInformation($raw_message['envelope']['dataMessage']);
            $reaction = self::parseReaction($raw_message['envelope']['dataMessage']);
            $mentions = self::parseMentions($raw_message['envelope']['dataMessage']);

        } else {
            throw new UnknownMessageFormatError();
        }

        // TODO: base64_attachments
        $base64_attachments = [];

        return new self(
            $source,
            $source_number,
            $source_uuid,
            $timestamp,
            $type,
            $text,
            $base64_attachments,
            $group,
            $reaction,
            $mentions,
            $raw_message
        );
    }

    /**
     * @throws UnknownMessageFormatError
     */
    private static function parseSyncMessage($sync_message)
    {
        try {
            return $sync_message['sentMessage']['message'];
        } catch (Exception $e) {
            throw new UnknownMessageFormatError();
        }
    }

    /**
     * @throws UnknownMessageFormatError
     */
    private static function parseDataMessage($data_message)
    {
        try {
            return $data_message['message'];
        } catch (Exception $e) {
            throw new UnknownMessageFormatError();
        }
    }

    private static function parseGroupInformation($message)
    {
        try {
            return $message['groupInfo']['groupId'];
        } catch (Exception $e) {
            return null;
        }
    }

    private static function parseMentions($data_message)
    {
        try {
            return $data_message['mentions'];
        } catch (Exception $e) {
            return [];
        }
    }

    private static function parseReaction($message)
    {
        try {
            return $message['reaction']['emoji'];
        } catch (Exception $e) {
            return null;
        }
    }

    public function __toString()
    {
        return $this->text ?? '';
    }
}
