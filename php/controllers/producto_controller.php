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
        public function redirectHeader(){
            header('Location: '.BASE_URL);
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
        
        public function redirectCerveza(){
            header('Location: '.BASE_URL."/cerveza");
        }
        public function addCerveza(){ //REVISAR
            if(isAdmin()){
                $id_estilo=$this->estilos_model->getIdEstilo($_POST['estilo']);
                $this->cervezas_model->addCerveza($_POST['nombre'],$_POST['imagen'],$id_estilo,$_POST['amargor'],$_POST['alcohol']);
                $this->redirectCerveza();
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
                $this->redirectCerveza();
            }else{
                $this->redirectHeader();
            }
        }

        public function displayEditCerveza($params = null){
            if(isAdmin()){
                $cerveza = $this->cervezas_model->getCerveza($params[":ID"]);
                $estilos = $this->estilos_model->getEstilos();
                $this->cervezas_view->displayEditCerveza($cerveza,$estilos);
            }else{
                $this->redirectHeader();
            }
        }

        public function editCerveza(){
            if(isAdmin()){
                $nombre=$_POST['nombre'];
                $imagen=$_POST['imagen'];
                $id_estilo=$this->estilos_model->getIdEstilo($_POST['estilo']);
                $amargor=$_POST['amargor'];
                $alcohol=$_POST['alcohol'];
                $id_cerveza=$_POST['id_cerveza'];
                $this->cervezas_model->updateCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol,$id_cerveza);
                $this->redirectCerveza();
            }else{
                $this->redirectHeader();
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
        
        public function redirectEstilo(){
            header('Location: '.BASE_URL."/estilo");
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
                
                $this->redirectEstilo();
            }else{
                $this->redirectHeader();
            }
        }

        public function displayAgregarEstilo(){
            if(isAdmin()){
                $this->estilos_view->displayAgregar();
            }else{
                $this->redirectHeader();
            }
        }

        public function deleteEstilo($id = null){
            if(isAdmin()){
                $this->estilos_model->deleteEstilo($id[":ID"]);
                $this->redirectEstilo();
            }else{
                $this->redirectHeader();
            }
        }

        public function displayEditEstilo($id = null){
            if(isAdmin()){
                $estilo = $this->estilos_model->getEstilo($id[":ID"]);
                $this->estilos_view->editEstilo($estilo);
            }else{
                $this->redirectHeader();
            }
        }
        public function editEstilo(){
            if(isAdmin()){
                $id=$_POST['id_estilo'];
                $nombre=$_POST['nombre'];
                $color=$_POST['color'];
                $aroma=$_POST['aroma'];
                $apariencia=$_POST['apariencia'];
                $sabor=$_POST['sabor'];
                $amargor_min=$_POST['amargor_min'];
                $amargor_max=$_POST['amargor_max'];
                $alcohol_min=$_POST['alcohol_min'];
                $alcohol_max=$_POST['alcohol_max'];
                $this->estilos_model->updateEstilo($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max,$id);
                
                $this->redirectEstilo();
            }else{
                $this->redirectHeader();
            }
        }

    }