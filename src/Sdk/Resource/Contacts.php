<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Contacts\ListContacts;
use UseTheFork\Signal\Sdk\Requests\Contacts\SendSynchronizationMessageWithTheLocalContactsListToAllLinkedDevices;
use UseTheFork\Signal\Sdk\Requests\Contacts\UpdatesTheInfoAssociatedToNumberOnTheContactListIfTheContactDoesntExistYetItWillBeAdded;
use UseTheFork\Signal\Sdk\Resource;

class Contacts extends Resource
{
	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function listContacts(mixed $number): Response
	{
		return $this->connector->send(new ListContacts($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function updatesTheInfoAssociatedToNumberOnTheContactListIfTheContactDoesntExistYetItWillBeAdded(
		mixed $number,
	): Response
	{
		return $this->connector->send(new UpdatesTheInfoAssociatedToNumberOnTheContactListIfTheContactDoesntExistYetItWillBeAdded($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function sendSynchronizationMessageWithTheLocalContactsListToAllLinkedDevices(mixed $number): Response
	{
		return $this->connector->send(new SendSynchronizationMessageWithTheLocalContactsListToAllLinkedDevices($number));
	}
}
