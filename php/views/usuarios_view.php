<?php

    require_once "libs/Smarty.class.php";
    class usuarios_view{
        private $plantilla;

        public function __construct(){
            $this->plantilla = new Smarty();
        }
        public function displayRegister(){
            $this->plantilla->assign('titulo','Registrar Usuario');
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->display("templates/create_user.tpl");
        }
        

    }
