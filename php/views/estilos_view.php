<?php

    require_once "libs/Smarty.class.php";

    class estilos_view{

        private $plantilla;

        public function __construct(){
            $this->plantilla = new Smarty();
        }

        public function generateTable($list_estilos){
            $this->plantilla->assign('titulo','Estilos');
            $this->plantilla->assign('estilos',$list_estilos);
            $this->plantilla->display("templates/estilos_table.tpl");
        }
    }