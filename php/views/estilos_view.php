<?php

    require_once "libs/Smarty.class.php";

    class estilos_view{

        private $plantilla;

        public function __construct(){
            $this->plantilla = new Smarty();
        }

        public function generateTable($list_estilos, $admin){
            $this->plantilla->assign('titulo','Estilos');
            $this->plantilla->assign('estilos',$list_estilos);
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->assign('admin',$admin);
            $this->plantilla->display("templates/estilos_table.tpl");
        }

        public function displayAgregar(){
            $this->plantilla->assign('titulo','Agregar Estilo');
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->display("templates/add_estilo.tpl");
        }

        public function editEstilo($estilo){
            $this->plantilla->assign('titulo','Agregar Estilo');
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->assign('estilo',$estilo);
            $this->plantilla->display("templates/edit_estilo.tpl");
        }
    }