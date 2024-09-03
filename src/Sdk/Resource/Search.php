<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Search\CheckIfOneOrMorePhoneNumbersAreRegisteredWithTheSignalService;
use UseTheFork\Signal\Sdk\Resource;

class Search extends Resource
{
	/**
	 * @param mixed $number Registered Phone Number
	 * @param mixed $numbers Numbers to check
	 */
	public function checkIfOneOrMorePhoneNumbersAreRegisteredWithTheSignalService(
		mixed $number,
		mixed $numbers,
	): Response
	{
		return $this->connector->send(new CheckIfOneOrMorePhoneNumbersAreRegisteredWithTheSignalService($number, $numbers));
	}
}
