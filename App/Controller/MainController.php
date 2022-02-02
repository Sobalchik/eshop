<?php

namespace App\Controller;

use App\Lib\Render;
use App\Service\ExcursionService;

class MainController
{
	public static function showAllExcursion(): string
	{
		$excursions = ExcursionService::getExcursions();
		return Render::render("excursions",[ 'excursions' => $excursions]);
	}
}