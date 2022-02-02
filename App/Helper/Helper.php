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

}