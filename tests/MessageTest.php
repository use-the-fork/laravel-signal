<?php

  use UseTheFork\Signal\ValueObjects\Message;
  use UseTheFork\Signal\ValueObjects\MessageType;

  beforeEach(function () {
    $this->rawSyncMessage = '{"envelope":{"source":"+490123456789","sourceNumber":"+490123456789","sourceUuid":"<uuid>","sourceName":"<name>","sourceDevice":1,"timestamp":1632576001632,"syncMessage":{"sentMessage":{"timestamp":1632576001632,"message":"Uhrzeit","expiresInSeconds":0,"viewOnce":false,"mentions":[],"attachments":[],"contacts":[],"groupInfo":{"groupId":"<groupid>","type":"DELIVER"},"destination":null,"destinationNumber":null,"destinationUuid":null}}}}';
    $this->rawDataMessage = '{"envelope":{"source":"+490123456789","sourceNumber":"+490123456789","sourceUuid":"<uuid>","sourceName":"<name>","sourceDevice":1,"timestamp":1632576001632,"dataMessage":{"timestamp":1632576001632,"message":"Uhrzeit","expiresInSeconds":0,"viewOnce":false,"mentions":[],"attachments":[],"contacts":[],"groupInfo":{"groupId":"<groupid>","type":"DELIVER"}}}}';
    $this->rawReactionMessage = '{"envelope":{"source":"<source>","sourceNumber":"<source>","sourceUuid":"<uuid>","sourceName":"<name>","sourceDevice":1,"timestamp":1632576001632,"syncMessage":{"sentMessage":{"timestamp":1632576001632,"message":null,"expiresInSeconds":0,"viewOnce":false,"reaction":{"emoji":"👍","targetAuthor":"<target>","targetAuthorNumber":"<target>","targetAuthorUuid":"<uuid>","targetSentTimestamp":1632576001632,"isRemove":false},"mentions":[],"attachments":[],"contacts":[],"groupInfo":{"groupId":"<groupid>","type":"DELIVER"},"destination":null,"destinationNumber":null,"destinationUuid":null}}}}';
    $this->rawUserChatMessage = '{"envelope":{"source":"+490123456789","sourceNumber":"+490123456789","sourceUuid":"<uuid>","sourceName":"<name>","sourceDevice":1,"timestamp":1632576001632,"dataMessage":{"timestamp":1632576001632,"message":"Uhrzeit","expiresInSeconds":0,"viewOnce":false}},"account":"+49987654321","subscription":0}';

    $this->expectedSource = '+490123456789';
    $this->expectedTimestamp = 1632576001632;
    $this->expectedText = 'Uhrzeit';
    $this->expectedGroup = '<groupid>';
  });

  test('parse source own message', function () {
    $message = Message::parse($this->rawSyncMessage);
    expect($message->timestamp)->toBe($this->expectedTimestamp);
  });

  test('parse timestamp own message', function () {
    $message = Message::parse($this->rawSyncMessage);
    expect($message->source)->toBe($this->expectedSource);
  });

  test('parse type own message', function () {
    $message = Message::parse($this->rawSyncMessage);
    expect($message->type)->toBe(MessageType::SYNC_MESSAGE);
  });

  test('parse text own message', function () {
    $message = Message::parse($this->rawSyncMessage);
    expect($message->text)->toBe($this->expectedText);
  });

  test('parse group own message', function () {
    $message = Message::parse($this->rawSyncMessage);
    expect($message->group)->toBe($this->expectedGroup);
  });

  test('parse source foreign message', function () {
    $message = Message::parse($this->rawDataMessage);
    expect($message->timestamp)->toBe($this->expectedTimestamp);
  });

  test('parse timestamp foreign message', function () {
    $message = Message::parse($this->rawDataMessage);
    expect($message->source)->toBe($this->expectedSource);
  });

  test('parse type foreign message', function () {
    $message = Message::parse($this->rawDataMessage);
    expect($message->type)->toBe(MessageType::DATA_MESSAGE);
  });

  test('parse text foreign message', function () {
    $message = Message::parse($this->rawDataMessage);
    expect($message->text)->toBe($this->expectedText);
  });

  test('parse group foreign message', function () {
    $message = Message::parse($this->rawDataMessage);
    expect($message->group)->toBe($this->expectedGroup);
  });

  test('read reaction', function () {
    $message = Message::parse($this->rawReactionMessage);
    expect($message->reaction)->toBe('👍');
  });

  test('parse user chat message', function () {
    $message = Message::parse($this->rawUserChatMessage);
    expect($message->source)->toBe($this->expectedSource)
                            ->and($message->text)->toBe($this->expectedText)
                            ->and($message->timestamp)->toBe($this->expectedTimestamp)
                            ->and($message->group)->toBeNull();
  });
