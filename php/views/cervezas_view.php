<?php

    require_once "libs/Smarty.class.php";

    class cervezas_view{
        private $plantilla;
        public function __construct(){
            $this->plantilla = new Smarty();
        }

        public function generateTable($list_cervezas,$admin){
            $this->plantilla->assign('titulo','Lista de Cervezas');
            $this->plantilla->assign('cervezas',$list_cervezas);
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->assign('admin',$admin);//Falta implementar, viene como parámetro
            $this->plantilla->display("templates/cervezas_table.tpl");
        }

        public function displayEditCerveza($cerveza,$estilos){
            $this->plantilla->assign('titulo','Editar Cerveza');
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->assign('cerveza', $cerveza);
            $this->plantilla->assign('estilos', $estilos);
            $this->plantilla->display("templates/edit_cerveza.tpl");
        }

        public function displayAgregarCerveza($estilos){
            $this->plantilla->assign('titulo','Agregar Cerveza');
            $this->plantilla->assign('estilos', $estilos);
            $this->plantilla->assign('base', BASE_URL);
            $this->plantilla->display("templates/add_cerveza.tpl");
        }
    }