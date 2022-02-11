<?php

\App\Lib\Router::add(
	"GET",
	"/home",
	[\App\Controller\MainController::class, 'showTopExcursions']
);

\App\Lib\Router::add(
	"GET",
	"/placeholder",
	[\App\Controller\MainController::class, 'showPlaceHolder']
);

\App\Lib\Router::add(
	"POST",
	"/createOrder",
	[\App\Controller\MainController::class, 'createOrder']
);