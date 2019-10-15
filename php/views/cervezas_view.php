<?php

    require_once "../libs/Smarty.class.php";

    class cervezas_view{

        private $plantilla;
        private $titulo;

        public function __construct(){
            $this->plantilla = new Smarty();
            $this->titulo="Cervezas";
        }

        public function generateTable($list_cervezas){
            $data = array();

            foreach ($list_cervezas as $cerveza) {
                array_push($data,$cerveza);
            }
            $this->plantilla->assign('titulo',$this->titulo);
            $this->plantilla->assign('cervezas',$data);
            $this->plantilla->display("../templates/cervezas_table.tpl");
        }

    }