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
            }
            var_dump($user);
        }
        
        public function register(){
            $nombre=$_POST['nombre'];
            $pass=$_POST['password'];
            $mail=$_POST['email'];
            if (isset($_POST['admin'])){
                $admin=TRUE;
            }else{
                $admin=FALSE;
            }
            $this->model->registrarUsuario($nombre,$mail,$pass,$admin);
            $this->indexview->displayIndex(isLogged());
        }
        public function logOut(){
            finishSession();
            $this->indexview->displayIndex(isLogged());
        }

    }
