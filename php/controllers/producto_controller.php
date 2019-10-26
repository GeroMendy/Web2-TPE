<?php
    require_once "php/models/cervezas_model.php";
    require_once "php/models/estilos_model.php";
    require_once "php/views/cervezas_view.php";
    require_once "php/views/estilos_view.php";
    require_once "php/controllers/session_controller.php";

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
        private function redirectHeader(){
            header('Location: ');
        }
        // Functions para Cerveza.
        public function getCervezasSortedByEstilo(){
            $list_cervezas = $this->cervezas_model->getCervezasSortedByEstilo();
            $this->cervezas_view->generateTable($list_cervezas);
        }

        public function getCervezas(){
            $list_cervezas = $this->cervezas_model->getCervezas();
            $this->cervezas_view->generateTable($list_cervezas,TRUE);//VALIDAR SI ES ADMIN
        }

        public function getCerveza($id_cerveza){
            $cerveza = $this->cervezas_model->getCerveza($id_cerveza[":ID"]);
            $admin = isAdmin();
            $this->cervezas_view->generateTable([$cerveza],$admin);
        }

        public function addCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol){
            if(isAdmin()){
                $this->cervezas_model->addCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol);
                $this->getCervezas();
            }else{
                $this->redirectHeader();
            }
        }

        public function displayAgregarCerveza(){
            if(isAdmin()){
                $estilos = $this->estilos_model->getEstilos();
                $this->cervezas_view->displayAgregarCerveza($estilos);
            }else{
                $this->redirectHeader();
            }
        }

        public function deleteCerveza($params = null){
            if(isAdmin()){
                $this->cervezas_model->deleteCerveza($params[":ID"]);
                $this->getCervezas();
            }else{
                $this->redirectHeader();
            }
        }

        public function displayEditCerveza($params = null){
            $admin = isAdmin();
            if($admin){
                $cerveza = $this->cervezas_model->getCerveza($params[":ID"]);
                $estilos = $this->estilos_model->getEstilos();
                $this->cervezas_view->displayEditCerveza($cerveza,$estilos);
            }else{
                $this->redirectHeader();
            }
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
        public function getEstilo($params = null){
            $est=$this->estilos_model->getEstilo($params[":ID"]);
            $this->estilos_view->generateTable([$est]);
        }
    }