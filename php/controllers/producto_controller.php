<?php
    require_once "php/models/cervezas_model.php";
    require_once "php/models/estilos_model.php";
    require_once "php/views/cervezas_view.php";
    require_once "php/views/estilos_view.php";
    require_once "php/helpers/session_helper.php";
    require_once "php/helpers/isset_helper.php";
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

        public function index(){//Ruta por defecto
            $this->index_view->displayIndex(isLogged(),isAdmin(),getUserSessionNombre());
        }
        
        public function redirectHeader(){
            header('Location: '.BASE_URL);
        }

        // Functions para Cerveza.
        
        private function redirectCerveza(){
            header('Location: '.BASE_URL."/cerveza");
        }

        public function getCervezasSortedByEstilo(){
            $list_cervezas = $this->cervezas_model->getCervezasSortedByEstilo();
            $estilos = $this->estilos_model->getEstilos();
            $this->cervezas_view->generateTable($list_cervezas,isAdmin(),$estilos);
        }

        public function getCervezas(){
            $list_cervezas = $this->cervezas_model->getCervezas();
            $estilos = $this->estilos_model->getEstilos();
            $this->cervezas_view->generateTable($list_cervezas,isAdmin(),$estilos);
        }

        public function getCerveza($id_cerveza){
            if( !validData($id_cerveza,array(":ID")) ){
                $this->redirectCerveza();
            }
            $cerveza = $this->cervezas_model->getCerveza($id_cerveza[":ID"]);
            $this->cervezas_view->displayCerveza($cerveza,isAdmin(),isLogged());
        }
        
        public function getCervezasByEstilo(){
            if( !isset($_GET['estilo']) || $_GET['estilo']=='' ){
                $this->redirectCerveza();
            }
            $id_estilo= $this->estilos_model->getIdEstilo($_GET['estilo']);
            $list_cervezas = $this->cervezas_model->getCervezasByEstilo($id_estilo);
            $estilos = $this->estilos_model->getEstilos();
            $this->cervezas_view->generateTable($list_cervezas,isAdmin(),$estilos);
        }
        public function addCerveza(){
            if(!validData(null,array('estilo','nombre','amargor','alcohol'))){
                //Pantalla de error.
                $this->redirectCerveza();
            }
            if(isAdmin()){
                $id_estilo=$this->estilos_model->getIdEstilo($_POST['estilo']);
                $imgs=$_FILES["imagesToUpload"]["tmp_name"];
                if ($imgs[0]!=""){
                    if ($this->sonIMG($imgs)){
                        $this->cervezas_model->addCerveza($_POST['nombre'],$id_estilo,$_POST['amargor'],$_POST['alcohol']);
                    }else{
                        echo ("Archivos inválidos");
                    }                
                }else $this->cervezas_model->addCerveza($_POST['nombre'],$id_estilo,$_POST['amargor'],$_POST['alcohol']);
                $this->redirectCerveza();
           }else{
               $this->redirectHeader();
           }
        }

        public function eliminarImagen($params = null){
            if(isAdmin()){
                if(!validData($params,array(':ID',':ARCH'))){
                    //pantalla error.
                    $this->redirectCerveza();
                }
                $this->cervezas_model->deleteImagen($params[":ID"],$params[":ARCH"]);
                header('Location: '.BASE_URL."/cerveza/editar/".$params[":ID"]);;
            }else{
                $this->redirectHeader();
            }
        }

        private function sonIMG($imagenesTipos){
            foreach ($imagenesTipos as $tipo) {
              if($tipo != ('image/jpeg'||'image/jpeg')) {
                return false;
              }
            }
            return true;
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
                if(!validData($params,array(':ID'))){
                    //pantalla error.
                    $this->redirectCerveza();
                }

                $this->cervezas_model->deleteCerveza($params[":ID"]);
                $this->redirectCerveza();
            }else{
                $this->redirectHeader();
            }
        }

        public function displayEditCerveza($params = null){
            if(isAdmin()){
                if(!validData($params,array(':ID'))){
                    //pantalla error.
                    $this->redirectCerveza();
                }

                $cerveza = $this->cervezas_model->getCerveza($params[":ID"]);
                $estilos = $this->estilos_model->getEstilos();
                $this->cervezas_view->displayEditCerveza($cerveza,$estilos);
            }else{
                $this->redirectHeader();
            }
        }

        public function editCerveza(){
            if(isAdmin()){
                if(!validData(null,array('estilo','nombre','amargor','alcohol','id_cerveza'))){
                    //pantalla error.
                    $this->redirectCerveza();
                }

                $nombre=$_POST['nombre'];
                $id_estilo=$this->estilos_model->getIdEstilo($_POST['estilo']);
                $amargor=$_POST['amargor'];
                $alcohol=$_POST['alcohol'];
                $id_cerveza=$_POST['id_cerveza'];
                $imgs=$_FILES["imagesToUpload"]["tmp_name"];
                if ($imgs[0]!=""){
                    if ($this->sonIMG($imgs)){
                        $this->cervezas_model->updateCerveza($nombre,$id_estilo,$amargor,$alcohol,$id_cerveza);
                    }else echo ("Archivos inválidos");
                }else $this->cervezas_model->updateCerveza($nombre,$id_estilo,$amargor,$alcohol,$id_cerveza);
                $this->redirectCerveza();
            }else{
                $this->redirectHeader();
            }
        }

        //Functions para Estilos.
        private function redirectEstilo(){
            header('Location: '.BASE_URL."/estilo");
        }
        
        public function getEstilos(){
            $list_estilos = $this->estilos_model->getEstilos();
            $this->estilos_view->generateTable($list_estilos,isAdmin());
        }
        
        public function getEstilo($id_estilo = null){
            if(!validData($id_estilo,array(':ID'))){
                //pantalla error.
                $this->redirectEstilo();
            }
            $est=$this->estilos_model->getEstilo($id_estilo[":ID"]);
            $this->estilos_view->generateTable([$est],isAdmin());
        }

        public function addEstilo(){
            if(isAdmin()){

                if(!validData(null,array('nombre','color','aroma','apariencia','sabor','amin','amax','almin','almax'))){      
                    //pantalla error.
                    $this->redirectEstilo();
                }

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
                
                if(!validData($id,array(':ID'))){
                    //pantalla error.
                    $this->redirectEstilo();
                }
                $this->estilos_model->deleteEstilo($id[":ID"]);
                $this->redirectEstilo();
            }else{
                $this->redirectHeader();
            }
        }

        public function displayEditEstilo($id = null){
            if(isAdmin()){
                if(!validData($id,array(':ID'))){
                    //pantalla error.
                    $this->redirectEstilo();
                }
                $estilo = $this->estilos_model->getEstilo($id[":ID"]);
                $this->estilos_view->editEstilo($estilo);
            }else{
                $this->redirectHeader();
            }
        }
        public function editEstilo(){
            if(isAdmin()){
                if(!validData(null,array('nombre','color','aroma','apariencia','sabor','amin','amax','almin','almax','id_estilo'))){      
                    //pantalla error.
                    $this->redirectEstilo();
                }
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