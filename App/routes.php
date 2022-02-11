<?php

use App\Controller\MainController;
use App\Lib\Router;

Router::add(
	"GET",
	"/home",
	[MainController::class, 'showTopExcursions']
);

Router::add(
	"GET",
	"/placeholder/:id",
	[MainController::class, 'showPlaceHolder']
);

Router::add(
	"GET",
	"/excursionById/:id",
	[MainController::class, 'showExcursionById']
);

Router::add(
	"GET",
	"/allExcursions",
	[MainController::class, 'showAllExcursions']
);

Router::add(
	"POST",
	"/createOrder",
	[MainController::class, 'createOrder']
);