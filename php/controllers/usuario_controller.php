<?php

    require_once "php/models/usuarios_model.php";
    require_once "php/controllers/session_controller.php";
    require_once "php/views/usuarios_view.php";
    require_once "php/views/index_view.php";

    class usuario_controller{

        private $model;
        private $view;
        private $indexview;

        public function __construct(){
            $this->model = new usuarios_model();
            $this->view = new usuarios_view();
            $this->indexview = new index_view();
        }

        public function displayRegister(){
            $this->view->displayRegister();
        }

        public function logIn(){
            $mail=$_POST['email'];
            $password=$_POST['password'];
            $user = $this->model->getUsuario($mail);
            if(!empty($user)&&md5($password)==$user->password){
                startSession($user);
                header('Location: '.BASE_URL);
            }else{
                $this->view->displayErrorLogin();
            }
        }
        
        public function register(){
            $nombre=$_POST['nombre'];
            $pass=$_POST['password'];
            $mail=$_POST['email'];
            $this->model->registrarUsuario($nombre,$mail,$pass);
            $this->logIn();
            $this->indexview->displayIndex(isLogged());
        }

        public function logOut(){
            finishSession();
            $this->indexview->displayIndex(isLogged(),isAdmin());
        }

        public function displayUserAdmin(){
            if (isAdmin()){
                $usuarios=$this->model->getUsuarios();
                $this->view->administrarUsuarios($usuarios);
            }
            else $this->indexview->displayIndex(isLogged(),isAdmin());
        }

        public function deleteUser($params = null){
            if(isAdmin()){
                $this->model->deleteUser($params[":ID"]);
                $this->displayUserAdmin();
            }else{
               header('Location: '.BASE_URL);;
            }
        }

        public function toggleAdmin($params = null){
            if(isAdmin()){
                $this->model->toggleAdmin($params[":ID"]);
                $this->displayUserAdmin();
            }else{
               header('Location: '.BASE_URL);;
            }
        }


    }
