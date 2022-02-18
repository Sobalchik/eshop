<?php

namespace App\Lib;

class Render
{
	public static function renderContent(string $viewName, array $parameters = []): ?string
	{
		extract($parameters, EXTR_OVERWRITE);
		ob_start();
		require(__DIR__ . "/../View/{$viewName}.php");
		return ob_get_clean();
	}

	public static function renderLayout(string $content, array $templateData = []): string
	{
		$data = array_merge($templateData, [
			'content' => $content,
		]);
		return self::renderContent("layout", $data);
	}

	public static function renderAdminMenu(string $content, array $templateData = []): string
	{
		$data = array_merge($templateData, [
			'content' => $content,
		]);
		return self::renderContent("admin", $data);
	}

	public  static  function  render(string $viewName, array $parameters = [] ) : string
		{
			$content = self::renderContent($viewName, $parameters);
			return self::renderLayout($content);
		}
}