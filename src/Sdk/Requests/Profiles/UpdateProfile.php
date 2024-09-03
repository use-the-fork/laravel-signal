<?php

namespace UseTheFork\Signal\Sdk\Requests\Profiles;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Update Profile.
 *
 * Set your name and optional an avatar.
 */
class UpdateProfile extends Request
{
	protected Method $method = Method::PUT;


	public function resolveEndpoint(): string
	{
		return "/v1/profiles/{$this->number}";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
