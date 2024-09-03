<?php

namespace UseTheFork\Signal\Sdk\Requests\StickerPacks;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * List Installed Sticker Packs.
 *
 * List Installed Sticker Packs.
 */
class ListInstalledStickerPacks extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/sticker-packs/{$this->number}";
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function __construct(
		protected mixed $number,
	) {
	}
}
