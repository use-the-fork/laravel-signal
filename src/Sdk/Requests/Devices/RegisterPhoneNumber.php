<?php

namespace UseTheFork\Signal\Sdk\Requests\Devices;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Register a phone number.
 *
 * Register a phone number with the signal network.
 */
class RegisterPhoneNumber extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/v1/register/{$this->number}";
	}

  protected function defaultBody(): array
  {
    return [
      'captcha' => $this->captcha,
      'use_voice' => $this->useVoice,
    ];
  }


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
		protected string|null $captcha,
		protected bool $useVoice = FALSE,
	) {
	}
}
