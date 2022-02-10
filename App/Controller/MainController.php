<?php

namespace App\Controller;

use App\Lib\Render;
use App\Service\ExcursionService;
use App\Config\Database;

class MainController
{
	public static function showTopExcursions(): string
	{
		$excursions = ExcursionService::getTopExcursions(Database::getInstance()->connect());
		return Render::render("content-card", ['excursions' => $excursions]);
	}

	public static function showPlaceHolder(): string
	{
		$excursions = ExcursionService::getExcursions(Database::getInstance()->connect());
		return Render::render("placeholder", ['excursions' => $excursions]);
	}
}