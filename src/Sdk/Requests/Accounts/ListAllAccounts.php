<?php

namespace UseTheFork\Signal\Sdk\Requests\Accounts;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * List all accounts
 *
 * Lists all of the accounts linked or registered
 */
class ListAllAccounts extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/v1/accounts";
	}


	public function __construct()
	{
	}
}
