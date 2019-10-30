<?php

    require_once "libs/Smarty.class.php";

    class index_view{

        private $plantilla;

        public function __construct(){
            $this->plantilla = new Smarty();
        }

        public function displayIndex($logged){
            $this->plantilla->assign('titulo','Índice');
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->assign('logged',$logged);
            $this->plantilla->display("templates/index.tpl");
        }
    }
    