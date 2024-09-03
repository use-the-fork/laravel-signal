<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Groups\AddOneOrMoreAdminsToExistingSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\AddOneOrMoreMembersToExistingSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\BlockSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\CreateNewSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\DeleteSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\JoinSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\ListAllSignalGroups;
use UseTheFork\Signal\Sdk\Requests\Groups\ListSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\QuitSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\RemoveOneOrMoreAdminsFromExistingSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\RemoveOneOrMoreMembersFromExistingSignalGroup;
use UseTheFork\Signal\Sdk\Requests\Groups\UpdateTheStateOfSignalGroup;
use UseTheFork\Signal\Sdk\Resource;

class Groups extends Resource
{
	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function listAllSignalGroups(mixed $number): Response
	{
		return $this->connector->send(new ListAllSignalGroups($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function createNewSignalGroup(mixed $number): Response
	{
		return $this->connector->send(new CreateNewSignalGroup($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $groupid Group ID
	 */
	public function listSignalGroup(mixed $number, mixed $groupid): Response
	{
		return $this->connector->send(new ListSignalGroup($number, $groupid));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $groupid Group ID
	 */
	public function updateTheStateOfSignalGroup(mixed $number, mixed $groupid): Response
	{
		return $this->connector->send(new UpdateTheStateOfSignalGroup($number, $groupid));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $groupid Group Id
	 */
	public function deleteSignalGroup(mixed $number, mixed $groupid): Response
	{
		return $this->connector->send(new DeleteSignalGroup($number, $groupid));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function addOneOrMoreAdminsToExistingSignalGroup(mixed $number): Response
	{
		return $this->connector->send(new AddOneOrMoreAdminsToExistingSignalGroup($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function removeOneOrMoreAdminsFromExistingSignalGroup(mixed $number): Response
	{
		return $this->connector->send(new RemoveOneOrMoreAdminsFromExistingSignalGroup($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $groupid Group ID
	 */
	public function blockSignalGroup(mixed $number, mixed $groupid): Response
	{
		return $this->connector->send(new BlockSignalGroup($number, $groupid));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $groupid Group ID
	 */
	public function joinSignalGroup(mixed $number, mixed $groupid): Response
	{
		return $this->connector->send(new JoinSignalGroup($number, $groupid));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function addOneOrMoreMembersToExistingSignalGroup(mixed $number): Response
	{
		return $this->connector->send(new AddOneOrMoreMembersToExistingSignalGroup($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function removeOneOrMoreMembersFromExistingSignalGroup(mixed $number): Response
	{
		return $this->connector->send(new RemoveOneOrMoreMembersFromExistingSignalGroup($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $groupid Group ID
	 */
	public function quitSignalGroup(mixed $number, mixed $groupid): Response
	{
		return $this->connector->send(new QuitSignalGroup($number, $groupid));
	}
}
