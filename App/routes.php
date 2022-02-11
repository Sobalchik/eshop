<?php

use App\Controller\MainController;
use App\Lib\Router;

Router::add(
	"GET",
	"/",
	[MainController::class, 'showTopExcursions']
);

Router::add(
	"GET",
	"/excursion/:id",
	[MainController::class, 'showPlaceHolder']
);

Router::add(
	"GET",
	"/excursion-by-id/:id",
	[MainController::class, 'showExcursionById']
);

Router::add(
	"GET",
	"/allExcursions/:page",
	[MainController::class, 'showAllExcursions']
);

Router::add(
	"POST",
	"/createOrder",
	[MainController::class, 'createOrder']
);