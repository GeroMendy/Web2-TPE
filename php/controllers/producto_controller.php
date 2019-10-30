<?php
    require_once "php/models/cervezas_model.php";
    require_once "php/models/estilos_model.php";
    require_once "php/views/cervezas_view.php";
    require_once "php/views/estilos_view.php";
    require_once "php/controllers/session_controller.php";
    require_once "php/views/index_view.php";

    // Controller para Cervezas y Estilos.
    class producto_controller{
        private $cervezas_model;
        private $estilos_model;

        private $cervezas_view;
        private $estilos_view;
        
        private $index_view;

        public function __construct(){
            $this->cervezas_model = new cervezas_model();
            $this->cervezas_view = new cervezas_view();

            $this->estilos_model = new estilos_model();
            $this->estilos_view = new estilos_view();

            $this->index_view=new index_view();
        }
        public function index(){
            $this->index_view->displayIndex();
        }

        // Functions para Cerveza.
        public function getCervezasSortedByEstilo(){
            $list_cervezas = $this->cervezas_model->getCervezasSortedByEstilo();
            $this->cervezas_view->generateTable($list_cervezas,isAdmin());
        }

        public function getCervezas(){
            $list_cervezas = $this->cervezas_model->getCervezas();
            $this->cervezas_view->generateTable($list_cervezas,isAdmin());
        }

        public function getCerveza($id_cerveza){
            $cerveza = $this->cervezas_model->getCerveza($id_cerveza[":ID"]);
            $this->cervezas_view->generateTable([$cerveza],isAdmin());
        }

        public function addCerveza(){ //REVISAR
            if(isAdmin()){
                $id_estilo=$this->estilos_model->getIdEstilo($_POST['estilo']);
                $this->cervezas_model->addCerveza($_POST['nombre'],$_POST['imagen'],$id_estilo,$_POST['amargor'],$_POST['alcohol']);
             $this->getCervezas();
           }else{
               $this->index();
           }
        }

        public function displayAgregarCerveza(){
            if(isAdmin()){
                $estilos = $this->estilos_model->getEstilos();
                $this->cervezas_view->displayAgregarCerveza($estilos);
            }else{
                $this->index();
            }
        }

        public function deleteCerveza($params = null){
            if(isAdmin()){
                $this->cervezas_model->deleteCerveza($params[":ID"]);
                $this->getCervezas();
            }else{
                $this->index();
            }
        }

        public function displayEditCerveza($params = null){
            if(isAdmin()){
                $cerveza = $this->cervezas_model->getCerveza($params[":ID"]);
                $estilos = $this->estilos_model->getEstilos();
                $this->cervezas_view->displayEditCerveza($cerveza,$estilos);
            }else{
                $this->index();
            }
        }

        public function updateCerveza(){
            if(isAdmin()){
                $nombre=$_POST['nombre'];
                $imagen=$_POST['imagen'];
                $id_estilo=$this->estilos_model->getIdEstilo($_POST['estilo']);
                $amargor=$_POST['amargor'];
                $alcohol=$_POST['alcohol'];
                $id_cerveza=$_POST['id_cerveza'];
                $this->cervezas_model->updateCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol,$id_cerveza);
                $this->getCervezas();
            }else{
                $this->index();
            }
        }

        //Functions para Estilos.
        
        public function getEstilos(){
            $list_estilos = $this->estilos_model->getEstilos();
            $this->estilos_view->generateTable($list_estilos,isAdmin());
        }
        
        public function getEstilo($id_estilo = null){
            $est=$this->estilos_model->getEstilo($id_estilo[":ID"]);
            $this->estilos_view->generateTable([$est],isAdmin());
        }

        public function addEstilo(){
            if(isAdmin()){
                $nombre=$_POST['nombre'];
                $color=$_POST['color'];
                $aroma=$_POST['aroma'];
                $apariencia=$_POST['apariencia'];
                $sabor=$_POST['sabor'];
                $amargor_min=$_POST['amin'];
                $amargor_max=$_POST['amax'];
                $alcohol_min=$_POST['almin'];
                $alcohol_max=$_POST['almax'];
                $this->estilos_model->addEstilo($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max);
                $this->getEstilos();
            }else{
                $this->index();
            }
        }

        public function displayAgregarEstilo(){
            if(isAdmin()){
                $this->estilos_view->displayAgregar();
            }else{
                $this->index();
            }
        }

        public function deleteEstilo($id = null){
            if(isAdmin()){
                $this->estilos_model->deleteEstilo($id_estilo[":ID"]);
                $this->getEstilos();
            }else{
                $this->index();
            }
        }

        public function editEstilo($id = null){
            if(isAdmin()){
                $estilo = $this->estilos_model->getEstilo($id[":ID"]);
                $this->estilos_view->editEstilo($estilo);
            }else{
                $this->index();
            }
        }

        public function updateEstilo(){
            var_dump($_POST);
        }

    }