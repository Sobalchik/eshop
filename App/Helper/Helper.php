<?php

namespace App\Helper;

class Helper
{
	private static $instance;

	public static function getInstance()
	{
		if(self::$instance)
		{
			return  self::$instance;
		}

		self::$instance = new self();

		return self::$instance;
	}

	public static function conversionDateToNumber($date)
	{
		$date = date_create($date);
		return date_format($date, 'd');
	}

	public static function conversionDateToMonth($date)
	{
		$date = date_create($date);
		return date_format($date, 'M');
	}
}