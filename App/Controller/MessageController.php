<?php

namespace App\Controller;

use App\Lib\Render;

class MessageController
{
	public static function showErrorPage()
	{
		return Render::renderContent('error-404');
	}
	public static function showNotFoundPage()
	{

		return Render::renderContent('error-nothing-found');
	}

}