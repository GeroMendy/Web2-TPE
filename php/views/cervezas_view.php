<?php

    require_once "libs/Smarty.class.php";

    class cervezas_view{
        private $plantilla;
        public function __construct(){
            $this->plantilla = new Smarty();
        }

        public function generateTable($list_cervezas,$admin,$estilos){
            $this->plantilla->assign('titulo','Lista de Cervezas');
            $this->plantilla->assign('cervezas',$list_cervezas);
            $this->plantilla->assign('estilos',$estilos);
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->assign('admin',$admin);
            $this->plantilla->display("templates/cervezas_table.tpl");
        }

        public function displayEditCerveza($cerveza,$estilos){
            $this->plantilla->assign('titulo','Editar Cerveza');
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->assign('cerveza', $cerveza);
            $this->plantilla->assign('estilos', $estilos);
        //    $archivos= array_diff(scandir("./img/cervezas/"), array('..', '.'));
        //    $this->plantilla->assign('imagenes', $archivos);
            $this->plantilla->display("templates/edit_cerveza.tpl");
        }

        public function displayCerveza($cerveza,$admin,$logged){
            $this->plantilla->assign('titulo',$cerveza->nombre);
            $this->plantilla->assign('base',BASE_URL);
            $this->plantilla->assign('cerveza', $cerveza);
            $imgs=array_diff(scandir("./img/cervezas/".$cerveza->imagen), array('..', '.'));
            $this->plantilla->assign('imagenes',$imgs);
            $this->plantilla->assign('admin',$admin);
            $this->plantilla->assign('logged',$logged);
            $this->plantilla->display("templates/cerveza_unica.tpl");
        }
        public function displayAgregarCerveza($estilos){
            $this->plantilla->assign('titulo','Agregar Cerveza');
            $this->plantilla->assign('estilos', $estilos);
            $this->plantilla->assign('base', BASE_URL);
          //  $archivos= array_diff(scandir("./img/cervezas/"), array('..', '.'));
           // $this->plantilla->assign('imagenes', $archivos);
            $this->plantilla->display("templates/add_cerveza.tpl");
        }

        public function displayEditImgs($dir,$id){
            $this->plantilla->assign('titulo','Gestionar imagenes');
            $this->plantilla->assign('base', BASE_URL);
            $this->plantilla->assign('id', $id);
            $imgs=array_diff(scandir($dir), array('..', '.'));
            $this->plantilla->assign('archivos', $imgs);
            $this->plantilla->assign('directorio', $dir);
            $this->plantilla->display("templates/gestion_imgs.tpl");
        }
    }