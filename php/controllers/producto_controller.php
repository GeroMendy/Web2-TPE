<?php
    require_once "php/models/cervezas_model.php";
    require_once "php/models/estilos_model.php";
    require_once "php/views/cervezas_view.php";
    require_once "php/views/estilos_view.php";
    // Controller para Cervezas y Estilos.
    class producto_controller{
        private $cervezas_model;
        private $estilos_model;

        private $cervezas_view;
        private $estilos_view;

        public function __construct(){
            $this->cervezas_model = new cervezas_model();
            $this->cervezas_view = new cervezas_view();

            $this->estilos_model = new estilos_model();
            $this->estilos_view = new estilos_view();
        }
        // Functions para Cerveza.
        public function getCervezasSortedByEstilo(){
            $list_cervezas = $this->cervezas_model->getCervezasSortedByEstilo();
            $this->cervezas_view->generateTable($list_cervezas);
        }

        public function getCervezas(){
            $list_cervezas = $this->cervezas_model->getCervezas();
            $this->cervezas_view->generateTable($list_cervezas);
        }

        public function getCerveza($id_cerveza){
            var_dump($id_cerveza);
            $cerveza = $this->cervezas_model->getCerveza($id_cerveza[":ID"]);
            $this->cervezas_view->generateTable([$cerveza]);
        }

        public function addCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol){//VALIDAR SI ES ADMIN
            $this->cervezas_model->addCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol);
            $this->getCervezas();
        }

        public function agregarCerveza(){
            $estilos = $this->estilos_model->getEstilos();
            $this->cervezas_view->addCerveza($estilos);
            //Cómo traigo los datos?
        }

        public function deleteCerveza($id_cerveza){//VALIDAR SI ES ADMIN
            $this->cervezas_model->deleteCerveza($id_cerveza[":ID"]);
            $this->getCervezas();
        }

        public function editCerveza($id){  //VALIDAR SI ES ADMIN
            $cerveza = $this->cervezas_model->getCerveza($id[":ID"]);
            $estilos = $this->estilos_model->getEstilos();
            $this->cervezas_view->editCerveza($cerveza,$estilos);
        }

        public function updateCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol,$id_cerveza){
            $this->cervezas_model->updateCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol,$id_cerveza);
            $this->getCervezas();
        }


        //Functions para Estilos.
        
        public function getEstilos(){
            $list_estilos = $this->estilos_model->getEstilos();
            $this->estilos_view->generateTable($list_estilos);
        }
        public function getEstilo($id_estilo){
            $est=$this->estilos_model->getEstilo($id_estilo[":ID"]);
            $this->estilos_view->generateTable([$est]);
        }
    }