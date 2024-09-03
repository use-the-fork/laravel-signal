<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Identities\ListIdentities;
use UseTheFork\Signal\Sdk\Requests\Identities\TrustIdentity;
use UseTheFork\Signal\Sdk\Resource;

class Identities extends Resource
{
	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function listIdentities(mixed $number): Response
	{
		return $this->connector->send(new ListIdentities($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $numberToTrust Number To Trust
	 */
	public function trustIdentity(mixed $number, mixed $numberToTrust): Response
	{
		return $this->connector->send(new TrustIdentity($number, $numberToTrust));
	}
}
