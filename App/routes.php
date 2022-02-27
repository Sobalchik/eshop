<?php

use App\Controller\ExcursionController;
use App\Controller\UserController;
use App\Controller\OrderController;
use App\Controller\TagController;
use App\Controller\MessageController;
use App\Lib\Router;


Router::add(
	"GET",
	"/",
	[ExcursionController::class, 'showTopExcursionsAction']
);

Router::add(
	"GET",
	"/allExcursions/",
	[ExcursionController::class, 'showAllExcursionsAction']
);

Router::add(
	"GET",
	"/excursion/:id",
	[ExcursionController::class, 'showExcursionById']
);

Router::add(
	"GET",
	"/allExcursions/excursion/:id",
	[ExcursionController::class, 'showExcursionById']
);


Router::add(
	"POST",
	"/createOrder",
	[OrderController::class, 'createOrder']
);

Router::add(
	"GET",
	"/login",
	[UserController::class, 'loginUser']
);

Router::add(
	"GET",
	"/logout",
	[UserController::class, 'logOutUser']
);

Router::add(
	"POST",
	"/admin/excursions",
	[UserController::class, 'Authorized']
);

Router::add(
	"POST",
	"/admin/excursions",
	[UserController::class, 'Authorized']
);

Router::add(
	"POST",
	"/admin/excursions/saved",
	[ExcursionController::class, 'editExcursion']
);

Router::add(
	"GET",
	"/admin/excursions",
	[ExcursionController::class, 'showAdminExcursionList']
);

Router::add(
	"GET",
	"/admin",
	[UserController::class, 'adminPanel']
);

Router::add(
	"GET",
	"/admin/detailed?id=:id",
	[ExcursionController::class, 'showAdminExcursionById']

);

Router::add(
	"GET",
	"/admin/orders",
	[OrderController::class, 'showAdminOrders']
);

Router::add(
	"POST",
	"/admin/orders/saved",
	[OrderController::class, 'editOrder']
);

Router::add(
	"POST",
	"/admin/orders/deleted",
	[OrderController::class, 'deleteOrder']
);

Router::add(
	"POST",
	"/admin/orders/find",
	[OrderController::class, 'findOrdersByClientName']
);

Router::add(
	"GET",
	"/admin/tags",
	[TagController::class, 'showAdminTags']
);

Router::add(
	"POST",
	"/admin/excursions/addDate",
	[ExcursionController::class, 'addExcursionDate']
);

Router::add(
	"POST",
	"/sort",
	[ExcursionController::class, 'sortExcursions']
);

Router::add(
	"POST",
	"/sortByTag",
	[ExcursionController::class, 'sortExcursionsByTags']
);

Router::add(
	"GET",
	"/admin/excursion/add",
	[ExcursionController::class, 'addExcursion']
);

Router::add(
	"POST",
	"/admin/tag/deleted?id=:id",
	[TagController::class, 'deleteTag']
);

Router::add(
	"POST",
	"/admin/typeTag/deleted?id=:id",
	[TagController::class, 'deleteTypeTag']
);

Router::add(
	"POST",
	"/admin/tag/saved",
	[TagController::class, 'saveTag']
);

Router::add(
	"POST",
	"/admin/tag/created",
	[TagController::class, 'addTag']
);

Router::add(
	"POST",
	"/admin/typeTag/created",
	[TagController::class, 'addTypeTag']
);

Router::add(
	"POST",
	"/admin/typeTag/saved",
	[TagController::class, 'saveTypeTag']
);

Router::add(
	"GET",
	"/about",
	[MessageController::class,'showAbout']
);

Router::add(
	"GET",
	"/client",
	[MessageController::class, 'showClient']
);

Router::add(
	"GET",
	"/blog",
	[MessageController::class, 'getBlog']
);

Router::add(
	"POST",
	"/admin/excursion/create",
	[ExcursionController::class, 'createExcursion']
);

Router::add(
	"POST",
	"/admin/excursion/found",
	[ExcursionController::class, 'showAdminExcursionListBySearch']
);

Router::add(
	"POST",
	"/allExcursions/found",
	[ExcursionController::class, 'showHomeExcursionListBySearch']
);

Router::add(
	"POST",
	"/admin/excursions/deleteDate",
	[ExcursionController::class, 'deleteExcursionDate']
);

Router::add(
	"GET",
	"/allExcursions/?order=:order",
	[ExcursionController::class, 'showAllExcursionsAction']
);

Router::add(
	"GET",
	"/admin/userChange/show",
	[UserController::class, 'showUserAction']
);

Router::add(
	"POST",
	"/admin/userChange/saved",
	[UserController::class, 'changeUserPasswordAction']
);


