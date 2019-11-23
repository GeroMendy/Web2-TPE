<?php

    require_once "php/models/comentarios_model.php";
    require_once "php/helpers/session_helper.php";
    require_once "php/api/ApiController.php";
    require_once "php/helpers/isset_helper.php";
    //SOME VIEW.

    class ComentarioApiController extends ApiController{

        private $model;

        public function __construct(){
            $this->model = new comentarios_model();
            parent::__construct();
        }
        public function getComentarios($id_cerveza = null){ //GET.
            if(!validData($id_cerveza,array(':ID_CERVEZA'))){
                return $this->view->response('Fallo al ingresar ID de cerveza',500);
            }
            $comentarios = $this->model->getComentarios($id_cerveza[':ID_CERVEZA']);
            return $this->view->response($comentarios,200);
        }

        public function addComentario($id_cerveza = null){ //POST.
            if(!!validData(null,array(':ID_CERVEZA'))){
                return $this->view->response('Fallo al ingresar ID de cerveza',500);
            }
            if(islogged()){
                $id_cerveza = $id_cerveza[':ID_CERVEZA'];
                $data = $this->getData();
                $texto = $data->texto;
                $valoracion = $data->valoracion;
                $id_usuario = getUserSessionId();
                $this->model->addComentario($id_usuario,$id_cerveza,$valoracion,$texto);
                return $this->view->response("Comentario agregado correctamente",200);
            }else{
                return $this->view->response("Usuario no Logueado" , 401);
            }
        }
        public function deleteComentario(){ //POST.

            $data = $this->getData();
            if(!validData($data,array('id_comentario'))){
                return $this->view->response("Fallo al ingresar ID de Comentario",500);
            }
            $id_comentario = $data['id_comentario'];
            if($this->model->getUserId($id_comentario)==''){
                return $this->view->response("Comentario no  encontrado",404);
            }
            if( $this->puedeBorrar($id_comentario) ){
                $this->model->deleteComentario($id_comentario);
                return $this->view->response("Comentario eliminado correctamente",200);
            }else{
                return $this->view->response("El usuario no tiene permisos para eliminar este comentario",401);
            }
        }
        public function editComentario(){ //POST.
            $data = $this->getData();

            if(!validData($data,array('id_comentario','valoracion','texto'))){
                return $this->view->response("Fallo al ingresar la informacion del Comentario",500);
            }

            $id_comentario = $data['id_comentario'];
            $id_usuario = $this->model->getUserId($id_comentario);
            if($id_usuario==''){
                return $this->view->response("Comentario no  encontrado",404);
            }
            if( isLogged() && $id_usuario==getUserSessionId() ){
                $valoracion = $data['valoracion'];
                $texto = $data['texto'];
                $this->model->editComentario($valoracion,$texto,$id_comentario);
                return $this->view->response("Comentario editado correctamente",200);
            }else{
                return $this->view->response("El usuario no tiene permisos para editar este comentario",401);
            }
        }
        private function puedeBorrar($id_comentario = null){
            if( isAdmin() ){ 
                return true; //Puede ser borrado por admins.
            }elseif( isLogged() ) {
                $id_usuario = $this->model->getUserId($id_comentario);
                return $id_usuario==getUserSessionId(); //Puede ser borrado por el usuario del comentario.
            }
            else{
                return false;
            }
        }
    }