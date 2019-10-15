<?php

    require_once "./models/usuarios_model.php";
    require_once "./views/usuarios_view.php";

    class usuario_controller{

        private $usuarios_model;
        private $usuarios_view;

        public function __construct(){
            $this->usuarios_model = new usuarios_model();
            $this->usuarios_view = new usuarios_view();
        }

        public function logIn($mail, $password){
            $user = $this->usuarios_model->getUsuario($mail);
            if(!empty($user)&&password_verify($password,$user->password)){
                
                startSession($user);

            }
        }
        public function register($nombre,$mail,$password){

            // debería ser  $admin = solicitarAdmin($mail);
            $admin =false;

            $this->usuaios_model->registrarUsuario($nombre,$mail,$password,$admin);

            logIn($mail, $password);

        }
        private function startSession($user){

            //Por las dudas
            finishSession();

            session_start();

            $_SESSION['usuario_nombre'] = $user->nombre;
            $_SESSION['usuario_mail'] = $user->mail ;
            $_SESSION['usuario_admin'] = ($user->admin==1||$user->admin=='1');
            $_SESSION['usuario_id'] = $user->id_usuario;
        }
        public function finishSession(){

            session_destroy();

        }
        public function isLogged(){
            session_start();
            return !empty($_SESSION['usuario_mail']);
        }
        public function isAdmin(){
            session_start();
            return (!empty($_SESSION['usuario_admin'])&&$_SESSION['usuario_admin']);
        }

    }
