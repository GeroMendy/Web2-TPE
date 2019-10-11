<?php

    require_once "./models/usuarios_model.php";
    require_once "./views/usuarios_view.php";

    class usuario_controller{

        private $usuarios_model;
        private $usuarios_view;

        public function __construct(){
            $this->usuarios_model = new usuarios_model();
            $this->usuarios_view = new usuarios_view();
        }

        /* A implementar a partir del 03/10 (Clase teórico-práctica de Web2 - "Autenticación de Ususarios").

        public function logIn($mail, $password){

        }
        */

    }

?>