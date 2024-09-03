<?php

namespace UseTheFork\Signal\Sdk;

use Saloon\Http\Connector;
use UseTheFork\Signal\Sdk\Resource\Accounts;
use UseTheFork\Signal\Sdk\Resource\Attachments;
use UseTheFork\Signal\Sdk\Resource\Contacts;
use UseTheFork\Signal\Sdk\Resource\Devices;
use UseTheFork\Signal\Sdk\Resource\General;
use UseTheFork\Signal\Sdk\Resource\Groups;
use UseTheFork\Signal\Sdk\Resource\Identities;
use UseTheFork\Signal\Sdk\Resource\Messages;
use UseTheFork\Signal\Sdk\Resource\Profiles;
use UseTheFork\Signal\Sdk\Resource\Reactions;
use UseTheFork\Signal\Sdk\Resource\Receipts;
use UseTheFork\Signal\Sdk\Resource\Search;
use UseTheFork\Signal\Sdk\Resource\StickerPacks;

/**
 * Signal Cli REST API
 *
 * This is the Signal Cli REST API documentation.
 */
class SignalConnector extends Connector
{
	public function resolveBaseUrl(): string
	{
		return config('signal.api_host');
	}


	public function accounts(): Accounts
	{
		return new Accounts($this);
	}


	public function attachments(): Attachments
	{
		return new Attachments($this);
	}


	public function contacts(): Contacts
	{
		return new Contacts($this);
	}


	public function devices(): Devices
	{
		return new Devices($this);
	}


	public function general(): General
	{
		return new General($this);
	}


	public function groups(): Groups
	{
		return new Groups($this);
	}


	public function identities(): Identities
	{
		return new Identities($this);
	}


	public function messages(): Messages
	{
		return new Messages($this);
	}


	public function profiles(): Profiles
	{
		return new Profiles($this);
	}


	public function reactions(): Reactions
	{
		return new Reactions($this);
	}


	public function receipts(): Receipts
	{
		return new Receipts($this);
	}


	public function search(): Search
	{
		return new Search($this);
	}


	public function stickerPacks(): StickerPacks
	{
		return new StickerPacks($this);
	}
}
