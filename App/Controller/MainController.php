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
		return Render::render("layout",[ 'excursions' => $excursions]);
	}
}