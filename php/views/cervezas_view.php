<?php

    require_once "../libs/Smarty.class.php";

    class cervezas_view{

        private $plantilla;
<<<<<<< HEAD
        private $titulo;
=======
        private $tituto;
>>>>>>> 1bdbda0b4617b5e1ec1aa2cf3dae0d000a9b16b4

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