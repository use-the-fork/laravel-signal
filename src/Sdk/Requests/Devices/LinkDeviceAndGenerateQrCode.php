<?php

namespace UseTheFork\Signal\Sdk\Requests\Devices;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Link device and generate QR code.
 *
 * Link device and generate QR code
 */
class LinkDeviceAndGenerateQrCode extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/qrcodelink";
	}


	/**
	 * @param mixed $deviceName Device Name
	 * @param null|mixed $qrcodeVersion QRCode Version (defaults to 10)
	 */
	public function __construct(
		protected mixed $deviceName,
		protected mixed $qrcodeVersion = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter(['device_name' => $this->deviceName, 'qrcode_version' => $this->qrcodeVersion]);
	}
}
