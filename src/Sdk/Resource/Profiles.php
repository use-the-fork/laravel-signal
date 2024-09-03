<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Profiles\UpdateProfile;
use UseTheFork\Signal\Sdk\Resource;

class Profiles extends Resource
{
	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function updateProfile(mixed $number): Response
	{
		return $this->connector->send(new UpdateProfile($number));
	}
}
