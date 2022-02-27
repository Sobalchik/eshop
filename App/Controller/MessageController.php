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

	public static function showAbout(): string
	{
		return Render::render("about","layout");
	}

	public static function showClient(): string
	{
		return Render::render("client","layout");
	}

	public static function getBlog(): string
	{
		return Render::render("blog", "layout");
	}

}