<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\StickerPacks\AddStickerPack;
use UseTheFork\Signal\Sdk\Requests\StickerPacks\ListInstalledStickerPacks;
use UseTheFork\Signal\Sdk\Resource;

class StickerPacks extends Resource
{
	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function listInstalledStickerPacks(mixed $number): Response
	{
		return $this->connector->send(new ListInstalledStickerPacks($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function addStickerPack(mixed $number): Response
	{
		return $this->connector->send(new AddStickerPack($number));
	}
}
