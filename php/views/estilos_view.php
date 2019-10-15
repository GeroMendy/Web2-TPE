<?php

    require_once "../libs/Smarty.class.php";

    class estilos_view{

        private $plantilla;
        private $titulo;

        public function __construct(){
            $this->plantilla = new Smarty();
            $this->titulo="Estilos";
        }

        public function generateTable($list_estilos){
            $data = array();

            foreach ($list_estilos as $estilo) {
                array_push($data,$estilo);
            }
            $this->plantilla->assign('titulo',$this->titulo);
            $this->plantilla->assign('estilos',$data);
            $this->plantilla->display("../templates/estilos_table.tpl");
        }


    }
<<<<<<< HEAD
    
=======

?>
>>>>>>> 1bdbda0b4617b5e1ec1aa2cf3dae0d000a9b16b4
