<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\Reactions\RemoveReaction;
use UseTheFork\Signal\Sdk\Requests\Reactions\SendReaction;
use UseTheFork\Signal\Sdk\Resource;

class Reactions extends Resource
{
	public function sendReaction(): Response
	{
		return $this->connector->send(new SendReaction());
	}


	public function removeReaction(): Response
	{
		return $this->connector->send(new RemoveReaction());
	}
}
