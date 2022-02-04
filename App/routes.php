<?php

\App\Lib\Router::add(
	"GET",
	"/Public/index",
	[\App\Controller\MainController::class, 'showTopExcursions']);

\App\Lib\Router::add(
	"GET",
	"/Public/placeholder",
	[\App\Controller\MainController::class, 'showPlaceHolder']);

