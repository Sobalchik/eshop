<?php
namespace App\Controller;

use App\Lib\Render;
use App\Service\ExcursionService;
use App\Config\Database;

class MainController
{
	public static function showAllExcursion(): string
	{
		$excursions = ExcursionService::getExcursions(Database::getInstance()->connect()); // НУЖНО ПЕРЕДЕЛАТЬ КАК ТО ?
		$excursionListPages = Render::render("content-card",[ 'excursions' => $excursions]);
		return Render::renderLayout($excursionListPages,['sth' => 1]);
	}

	public static function showPlaceHolder(): string
	{
		$excursions = ExcursionService::getExcursions(Database::getInstance()->connect()); // НУЖНО ПЕРЕДЕЛАТЬ КАК ТО ?
		return  Render::render("placeholder",[ 'excursions' => $excursions]);

	}
}