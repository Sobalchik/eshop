<?php

namespace App\Lib;

class Router
{
	protected static $routes = [];

	/**
	 * Adds new route to the router.
	 *
	 * @param string $method HTTP request method (GET|POST|PUT|DELETE).
	 * @param string $urlTemplate URL template with parameters placeholders, like (/user/:user_id).
	 * @param callable $callback Handler for this route.
	 * @return void
	 */
	public static function add(string $method, string $urlTemplate, callable $callback)
	{
		static::$routes[] = [
			'method' => $method,
			'urlTemplate' => $urlTemplate,
			'urlRegex' =>  static::makeRegexFromUrl($urlTemplate),
			'callback' => $callback
		];
	}

	public static function route(string $method, string $url): ?array
	{

		foreach (static::$routes as $route)
		{
			$matches = [];
			if ($method === $route['method'] && preg_match($route['urlRegex'], $url, $matches))
			{
				return [
					'callback' => $route['callback'],
					'params' => $matches
				];
			}
		}
		return null;
	}

	/**
	 * @param string $urlTemplate
	 * @return string
	 */
	public static function makeRegexFromUrl(string $urlTemplate): string
	{
		return "#^"
			. preg_replace('/\\\:([\w_]+)/', '(?<$1>[a-zA-Z0-9\-\_]+)', preg_quote($urlTemplate))
			. "$#D";
	}
}