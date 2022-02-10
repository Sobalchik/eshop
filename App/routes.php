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
