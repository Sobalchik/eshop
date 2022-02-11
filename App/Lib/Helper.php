<?php

namespace App\Lib;

class Helper
{
	private static $instance;

	public static function getInstance(): Helper
	{
		if (self::$instance)
		{
			return self::$instance;
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

	public static function conversionDateToTime($date): string
	{
		$date = date_create($date);
		$hours = date_format($date, 'H');
		$minutes = date_format($date, 'i');
		return "{$hours}ч:{$minutes}мин";
	}

	public static function conversionCelsiusToFahrenheit($celsius)
	{
		return ($celsius * 9 / 5) + 32;
	}

	public static function priceInUsd($priceInRub)
	{
		static $rates;

		if ($rates === null)
		{
			$rates = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'));
		}
		$data = $priceInRub / $rates->Valute->USD->Value;
		return round($data, 2);
	}

	public static function generateFormCsrfToken()
	{
		session_start();
		return $_SESSION['csrf_token'] = substr( str_shuffle( 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM' ), 0, 10 );
	}

	public static function getPagesCount(array $excursions) : int
	{
		$EXCURSIONS_ON_PAGE = 9;

		$total = count($excursions);

		return ceil($total / $EXCURSIONS_ON_PAGE);
	}

}