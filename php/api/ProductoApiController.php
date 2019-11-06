<?php
    require_once ("php/models/cervezas_model.php");
    require_once ("php/api/ApiController.php");
    require_once ("php/api/JSONView.php");
    
    class ProductoApiController extends ApiController{
            
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

          public function getTarea($params = null) {
            // obtiene el parametro de la ruta
            $id = $params[':ID'];
            
            $tarea = $this->model->GetTarea($id);
            
            if ($tarea) {
                $this->view->response($tarea, 200);   
            } else {
                $this->view->response("No existe la tarea con el id={$id}", 404);
            }
        }
    

    }
