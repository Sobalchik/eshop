<?php

namespace Service;

use Entity\Excursion;

class ExcursionService
{
	public static function getExcursions()
	{
		return "Excursions";
	}

	public static function getExcursionsByTag()
	{
		return "ExcursionsByTag";
	}

	public static function addExcursion()
	{
		return "Excursion Added";
	}
}