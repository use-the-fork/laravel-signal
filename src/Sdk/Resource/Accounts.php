<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Accounts\LiftRateLimitRestrictionsBySolvingCaptcha;
use UseTheFork\Signal\Sdk\Requests\Accounts\ListAllAccounts;
use UseTheFork\Signal\Sdk\Requests\Accounts\RemoveUsername;
use UseTheFork\Signal\Sdk\Requests\Accounts\SetUsername;
use UseTheFork\Signal\Sdk\Requests\Accounts\UpdateTheAccountSettings;
use UseTheFork\Signal\Sdk\Resource;

class Accounts extends Resource
{
	public function listAllAccounts(): Response
	{
		return $this->connector->send(new ListAllAccounts());
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function liftRateLimitRestrictionsBySolvingCaptcha(mixed $number): Response
	{
		return $this->connector->send(new LiftRateLimitRestrictionsBySolvingCaptcha($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function updateTheAccountSettings(mixed $number): Response
	{
		return $this->connector->send(new UpdateTheAccountSettings($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function setUsername(mixed $number): Response
	{
		return $this->connector->send(new SetUsername($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function removeUsername(mixed $number): Response
	{
		return $this->connector->send(new RemoveUsername($number));
	}
}
