<?php
require_once("php/router.php");
require_once("php/api/ProductoApiController.php");
require_once("php/api/ComentarioApiController.php");

$router = new Router();




$router->addRoute('cerveza', 'GET', "ProductoApiController", "getCervezas");
$router->addRoute('cerveza/:ID','GET', "ProductoApiController","getCerveza");

$router->addRoute('comentario/agregar/:ID_CERVEZA','POST','ComentarioApiController','addComentario');
$router->addRoute('comentario/eliminar/:ID','DELETE','ComentarioApiController','deleteComentario');

$router->addRoute('comentario/:ID_CERVEZA','GET','ComentarioApiController','getComentarios');




$router->setDefaultRoute("ProductoApiController","getCervezas");  

$router->route($_GET["resource"],$_SERVER['REQUEST_METHOD']);