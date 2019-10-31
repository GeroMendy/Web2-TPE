<?php
    require_once("php/controllers/producto_controller.php");
    require_once("php/controllers/usuario_controller.php");
    require_once("php/router.php");
    
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]));
    define("LOGIN", BASE_URL . 'login');
    define("VER", BASE_URL . 'ver');
    define("USER_C" , 'usuario_controller');
    define("PROD_C" , 'producto_controller');
    $router = new Router();

    $router->addRoute("login","GET",USER_C,"displayLogIn");
    $router->addRoute("login","POST",USER_C,"logIn");
    $router->addRoute("logout","GET",USER_C,"logOut");
    

    $router->addRoute("register","GET",USER_C,"displayRegister");
    $router->addRoute("register","POST",USER_C,"register");

    //Cervezas
    $router->addRoute("cerveza/sorted","GET",PROD_C,"getCervezasSortedByEstilo");
    $router->addRoute("cerveza","GET",PROD_C,"getCervezas");

    $router->addRoute("cerveza/editar/:ID","GET",PROD_C,"displayEditCerveza");
    $router->addRoute("cerveza/editar/:ID", "POST", PROD_C, "editCerveza");
    
    $router->addRoute("cerveza/eliminar/:ID","GET",PROD_C,"deleteCerveza");
    
    $router->addRoute("cerveza/agregar","GET",PROD_C,"displayAgregarCerveza");
    $router->addRoute("cerveza/agregar","POST",PROD_C,"addCerveza");

    $router->addRoute("cerveza/:ID","GET",PROD_C,"getCerveza");
    //Cervezas

    //Estilos
    $router->addRoute("estilo","GET",PROD_C,"getEstilos");

    $router->addRoute("estilo/editar/:ID","GET",PROD_C,"displayEditEstilo"); 
    $router->addRoute("estilo/editar/:ID", "POST", PROD_C, "editEstilo");
    
    $router->addRoute("estilo/eliminar/:ID","GET",PROD_C,"deleteEstilo");

    $router->addRoute("estilo/agregar","GET",PROD_C,"displayAgregarEstilo");
    $router->addRoute("estilo/agregar","POST",PROD_C,"addEstilo");

    $router->addRoute("estilo/:ID","GET",PROD_C,"getEstilo");
    //Estilos
    
    $router->setDefaultRoute(PROD_C,"index");    
    $router->route($_GET["action"], $_SERVER['REQUEST_METHOD']);

