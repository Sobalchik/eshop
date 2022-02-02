<?php

namespace App\Lib;

class Render
{
	public static function render(string $viewName, array $parameters = []) :?string
	{
		extract($parameters, EXTR_OVERWRITE);
		ob_start();
		require (__DIR__."/../View/{$viewName}.php");
		return ob_get_clean();
	}

}