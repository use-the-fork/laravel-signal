<?php

namespace UseTheFork\Signal\Sdk\Requests\Accounts;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Lift rate limit restrictions by solving a captcha.
 *
 * When running into rate limits, sometimes the limit can be lifted, by solving a CAPTCHA. To get the
 * captcha token, go to https://signalcaptchas.org/challenge/generate.html For the staging environment,
 * use: https://signalcaptchas.org/staging/registration/generate.html. The "challenge_token" is the
 * token from the failed send attempt. The "captcha" is the captcha result, starting with
 * signalcaptcha://
 */
class LiftRateLimitRestrictionsBySolvingCaptcha extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/accounts/{$this->number}/rate-limit-challenge";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
