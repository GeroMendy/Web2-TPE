<?php

    require_once "php/models/comentarios_model.php";
    require_once "php/helpers/session_helper.php";
    //SOME VIEW.

    class ComentarioApiController{

        $model;

        public function __construct(){
            $this->model = new comentarios_model();
        }

#       TODO
#       public function displayComentar() //GET.
#       public function displayEditar() //GET.
#       public function getComentariosCerveza($id_cerveza) //GET.

        public function addComentario(){ //POST.
            if(islogged()){
                $texto = $_POST['texto'];
                $valoracion = $_POST['valoracion'];
                $id_cerveza = $_POST['id_cerveza'];
                $id_usuario = getUserSessionId();
                $this->model->addComentario($id_usuario,$id_cerveza,$valoracion,$texto);
            }
        }
        public function deleteComentario(){//POST.
            $id_comentario = $_POST['id_comentario'];
            $id_usuario = $this->model->getUserId($id_comentario);
            if( isAdmin() || ( islogged() && $id_usuario==getUserSessionId() ) ){//Puede ser borrado por admins o por el usuario del comentario.
                $this->model->deleteComentario($id_comentario);
            }
        }
        public function editComentario(){//POST.
            $id_comentario = $_POST['id_comentario'];
            $id_usuario = $this->model->getUserId($id_comentario);
            if( isLogged() && $id_usuario==getUserSessionId() ){
                $valoracion = $_POST['valoracion'];
                $texto = $_POST['texto'];
                $this->model->editComentario($valoracion,$texto,$id_comentario);
            }
        }
    }