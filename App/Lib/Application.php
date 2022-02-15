<?php

namespace App\Lib;

use App\Config\Database;
use App\Config\Settings;
use App\Database\Migration;
use App\Exception\NoConnectionToDataBaseException;
use App\Exception\PathNotFoundEcxeption;
use Exception;

class Application
{
	public static function run(): ?Response
	{
		$settings = Settings::getInstance();
		$database = Database::getInstance();

		try
		{
			$database->connect();
		}
		catch (NoConnectionToDataBaseException $exception)
		{
		}

		if ($settings->isDev())
		{
			$migration = new Migration(Database::getDatabase());
			$migration->up();
		}


		try
		{
			$route =  Router::route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
		}
		catch (PathNotFoundEcxeption $e)
		{
			$route = Response::error(405,"Ты дурак");
		}


		return $route;
	}
}