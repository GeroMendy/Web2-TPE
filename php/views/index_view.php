<?php

    require_once "libs/Smarty.class.php";

    class index_view{

        private $plantilla;

        public function __construct(){
            $this->plantilla = new Smarty();
        }

        public function displayIndex(){
            $this->plantilla->assign('titulo','Índice');
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->display("templates/index.tpl");
        }
    }
    