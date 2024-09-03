<?php

namespace UseTheFork\Signal\Sdk\Resource;

use Saloon\Http\Response;
use UseTheFork\Signal\Sdk\Requests\General\ApiHealthCheck;
use UseTheFork\Signal\Sdk\Requests\General\ListAccountSpecificSettings;
use UseTheFork\Signal\Sdk\Requests\General\ListTheRestApiConfiguration;
use UseTheFork\Signal\Sdk\Requests\General\ListsGeneralInformationAboutTheApi;
use UseTheFork\Signal\Sdk\Requests\General\SetAccountSpecificSettings;
use UseTheFork\Signal\Sdk\Requests\General\SetTheRestApiConfiguration;
use UseTheFork\Signal\Sdk\Resource;

class General extends Resource
{
	public function listsGeneralInformationAboutTheApi(): Response
	{
		return $this->connector->send(new ListsGeneralInformationAboutTheApi());
	}


	public function listTheRestApiConfiguration(): Response
	{
		return $this->connector->send(new ListTheRestApiConfiguration());
	}


	public function setTheRestApiConfiguration(): Response
	{
		return $this->connector->send(new SetTheRestApiConfiguration());
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function listAccountSpecificSettings(mixed $number): Response
	{
		return $this->connector->send(new ListAccountSpecificSettings($number));
	}


	/**
	 * @param mixed $number Registered Phone Number
	 */
	public function setAccountSpecificSettings(mixed $number): Response
	{
		return $this->connector->send(new SetAccountSpecificSettings($number));
	}


	public function apiHealthCheck(): Response
	{
		return $this->connector->send(new ApiHealthCheck());
	}
}
