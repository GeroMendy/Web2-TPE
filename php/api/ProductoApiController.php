<?php
    require_once "php/models/cervezas_model.php";
    require_once "php/api/ApiController.php";
    require_once "php/api/JSONView.php";
    require_once "php/helpers/isset_helper.php";
    
    class ProductoApiController extends ApiController{
        
        private $model;

        public function __construct(){
            $this->model = new cervezas_model();
            parent::__construct();
        }

        function getCervezas() {
            $cervezas = $this->model->getCervezas();
            return $this->view->response($cervezas, 200);
          }
      
          function getCerveza($params = null) {
            if(!validData($params,array(':ID'))){
                return $this->view->response("Fallo al ingresar ID de cerveza",500);
            }
            $id=$params[':ID'];
            $cerveza = $this->model->getCerveza($id);
            if ($cerveza){
                return $this->view->response($cerveza, 200);
            }else{
                return $this->view->response("No existe cerveza con id {$id}", 404);
            }  
          }
    }
