<?php

namespace App\Lib;

use App\Config\Database;
use App\Config\Settings;
use App\Database\Migration;
use Exception;

class Application
{
	public static function run(): ?Response
	{
		$settings = Settings::getInstance();
		$database = Database::getInstance();

		if($settings->isDev())
		{
			$migration = new Migration($database->connect());
			$migration->up();
		}




		return Router::route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
	}
}