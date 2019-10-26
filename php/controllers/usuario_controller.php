<?php

    require_once "php/models/usuarios_model.php";
    require_once "php/controllers/session_controller.php";
    //require_once "./views/usuarios_view.php";

    class usuario_controller{

        private $model;
//        private $view;

        public function __construct(){
            $this->model = new usuarios_model();
//            $this->view = new usuarios_view();
        }

        public function displayLogIn(){
            //$this->view->displayLogIn();
        }
        public function displayRegister(){
            //$this->view->displayRegister();
        }

        public function logIn($mail, $password){
            $user = $this->model->getUsuario($mail);
            if(!empty($user)&&md5($password)==$user->password){
                startSession($user);
            }
        }
        public function register($nombre,$mail,$password){
            // debería ser $admin = solicitarAdmin($mail);
            $admin =false;
            $this->model->registrarUsuario($nombre,$mail,$password,$admin);
            logIn($mail, $password);
        }
        public function logOut(){
            finishSession();
            $this->displayLogIn();
        }

        //ELIMINAR AL TERMINAR TESTING:
        public function DEBUG_logIn(){
            echo "LOGGING<br>";
            $this->logIn('debuger@code.com','a');
            echo "LOGGED<br>";
        }
        public function DEBUG_logOut(){
            $this->logOut();
        }
        public function DEBUG_printLog(){
            $data = [
            'nombre' => getUserSessionNombre(),
            'mail' => getUserSessionMail(),
            'id' => getUserSessionId(),
            'admin' => isAdmin()
            ];
            var_dump($data);
        }

    }
