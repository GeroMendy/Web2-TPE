<?php
    require_once("php/controllers/producto_controller.php");
    require_once("php/controllers/usuario_controller.php");
    require_once("php/router.php");
    
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
    define("LOGIN", BASE_URL . 'login');
    define("VER", BASE_URL . 'ver');
    define("USER_C" , 'usuario_controller');
    define("PROD_C" , 'producto_controller');
    $router = new Router();
    $router->addRoute("login","GET",USER_C,"displayLogIn");
    $router->addRoute("login","POST",USER_C,"logIn");
    $router->addRoute("register","GET",USER_C,"displayRegister");
    $router->addRoute("register","POST",USER_C,"register");
    $router->addRoute("estilo","GET",PROD_C,"getEstilos");
    $router->addRoute("estilo/:ID","GET",PROD_C,"getEstilo");
    $router->addRoute("cerveza","GET",PROD_C,"getCervezas");
    $router->addRoute("cerveza/:ID","GET",PROD_C,"getCerveza");
    
    $router->route($_GET["action"], $_SERVER['REQUEST_METHOD']);

