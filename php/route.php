<?php

    require_once("controllers/producto_controller.php");
    require_once("controllers/usuario_controller.php");
    require_once("Router.php");
    

    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
    define("LOGIN", BASE_URL . 'login');
    define("VER", BASE_URL . 'ver');
    define("USER_C" . 'usuario_controller');
    define("PROD_C" . 'producto_controller');

    $router = new Router();

    $router->addRoute("login","GET",USER_C,"displayLogIn");
    $router->addRoute("login","POST",USER_C,"logIn");

