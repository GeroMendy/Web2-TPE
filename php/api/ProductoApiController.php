<?php
    require_once ("php/models/cervezas_model.php");
    require_once ("php/api/ApiController.php");
    require_once ("php/api/JSONView.php");
    
    class ProductoApiController extends ApiController{
        
        private $model;

        public function __construct(){
            $this->model = new cervezas_model();
            parent::__construct();
        }

        function getCervezas($params = []) {
            $cervezas = $this->model->getCervezas();
            return $this->view->response($cervezas, 200);
          }
      
          function getCerveza($params = []) {
            $id=$params[':ID'];
            $cerveza = $this->model->getCerveza($id);
            if ($cerveza){
                $this->view->response($cerveza, 200);
            }else{
                $this->view->response("No existe cerveza con id {$id}", 404);
            }  
          }
    }
