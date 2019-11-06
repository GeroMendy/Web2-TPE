<?php
require_once("php/router.php");
require_once("php/api/ProductoApiController.php");

$router = new Router();

$router->addRoute('cerveza', 'GET', "ProductoApiController", "getCervezas");
$router->addRoute('cerveza/:ID','GET', "ProductoApiController","getCerveza");

$router->setDefaultRoute("ProductoApiController","getCervezas");  

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);