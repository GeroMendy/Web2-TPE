<?php

    require_once "controllers/producto_controller.php";

    $x = new producto_controller();

    //$x->getCerveza(3);
    //$x->addCerveza("Arg Ipa","blonde.jpg",4,45,7);
    //$x->getCervezas();
    //$x->getEstilos();
    //$x->getCervezasSortedByEstilo();
    //$x->deleteCerveza(5);
    $x->editCerveza(4);
?>