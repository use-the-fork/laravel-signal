<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Receipts\SendReceipt;
use UseTheFork\Signal\Sdk\Resource;

class Receipts extends Resource
{
	public function sendReceipt(): Response
	{
		return $this->connector->send(new SendReceipt());
	}
}
