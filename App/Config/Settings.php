<?php

namespace App\Config;

class Settings
{
	private $isDev;
	private $excursionOnPage;
	private static $instance;

	public function __construct()
	{
		$ini = parse_ini_file('config.ini');
		$this->isDev = $ini['isDev'];
		$this->excursionOnPage = $ini['excursions_on_page'];
	}

	public static function getInstance(): Settings
	{
		if (self::$instance)
		{
			return self::$instance;
		}

		self::$instance = new Settings();

		return self::$instance;
	}

	/**
	 * @return mixed
	 */
	public function isDev()
	{
		return $this->isDev;
	}

	/**
	 * @return mixed
	 */
	public function getExcursionOnPage()
	{
		return $this->excursionOnPage;
	}

}