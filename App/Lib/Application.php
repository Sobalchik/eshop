<?php

namespace App\Lib;

use Exception;

class Application
{
	public static function run(): ?Response
	{
		$callback = \App\Lib\Router::route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

		if ($callback === null)
		{
			return Response::error(404, "Not Found");
		}

		$params = $callback['params'];

		if (is_array($callback['callback']))
		{
			$callbackReflection = new \ReflectionMethod($callback['callback'][0], $callback['callback'][1]);
		}
		elseif (is_string($callback['callback']) || is_callable($callback['callback']))
		{
			$callbackReflection = new \ReflectionFunction($callback['callback']);
		}

		$args = [];
		foreach ($callbackReflection->getParameters() as $parameter)
		{
			if (isset($params[$parameter->getName()]))
			{
				$args[] = $params[$parameter->getName()];
			}
			else
			{
				if (!$parameter->isDefaultValueAvailable())
				{
					throw new \Exception("No value for parameter $" . $parameter->getName());
				}
			}
		}

		try
		{
			$result = call_user_func_array($callback['callback'], $args);
		}
		catch (Exception $e)
		{
			// TODO: журналируем и выводим исключение
			return null;
		}
		if ($result instanceof Response)
		{
			return $result;
		}
		if (is_array($result))
		{
			return Response::json($result);
		}
		if (is_string($result))
		{
			return Response::text($result);
		}

		return Response::error('404', 'Not Found');
	}
}