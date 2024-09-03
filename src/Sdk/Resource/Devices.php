<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Devices\LinkDeviceAndGenerateQrCode;
use UseTheFork\Signal\Sdk\Requests\Devices\LinksAnotherDeviceToThisDevice;
use UseTheFork\Signal\Sdk\Requests\Devices\RegisterPhoneNumber;
use UseTheFork\Signal\Sdk\Requests\Devices\UnregisterPhoneNumber;
use UseTheFork\Signal\Sdk\Requests\Devices\VerifyRegisteredPhoneNumber;
use UseTheFork\Signal\Sdk\Resource;

class Devices extends Resource
{
  /**
   * @param mixed $number Registered Phone Number
   *
   * @return Response
   * @throws FatalRequestException
   * @throws RequestException
   */
	public function linksAnotherDeviceToThisDevice(mixed $number): Response
	{
		return $this->connector->send(new LinksAnotherDeviceToThisDevice($number));
	}

  /**
   * @param mixed $deviceName    Device Name
   * @param mixed $qrcodeVersion QRCode Version (defaults to 10)
   *
   * @return Response
   * @throws FatalRequestException
   * @throws RequestException
   */
	public function linkDeviceAndGenerateQrCode(mixed $deviceName, mixed $qrcodeVersion): Response
	{
		return $this->connector->send(new LinkDeviceAndGenerateQrCode($deviceName, $qrcodeVersion));
	}

  /**
   * @param string $number Registered Phone Number
   * @param string $captcha
   * @param bool   $useVoice
   *
   * @return Response
   * @throws FatalRequestException
   * @throws RequestException
   */
	public function registerPhoneNumber(string $number, string $captcha = null, bool $useVoice = FALSE): Response
	{
		return $this->connector->send(new RegisterPhoneNumber($number, $captcha , $useVoice));
	}

  /**
   * @param string $number Registered Phone Number
   * @param string $token  Verification Code
   *
   * @return Response
   * @throws FatalRequestException
   * @throws RequestException
   */
	public function verifyRegisteredPhoneNumber(string $number, string $token): Response
	{
		return $this->connector->send(new VerifyRegisteredPhoneNumber($number, $token));
	}

  /**
   * @param mixed $number Registered Phone Number
   *
   * @return Response
   * @throws FatalRequestException
   * @throws RequestException
   */
	public function unregisterPhoneNumber(mixed $number): Response
	{
		return $this->connector->send(new UnregisterPhoneNumber($number));
	}
}
