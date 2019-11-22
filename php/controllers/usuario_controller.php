<?php

    require_once "php/models/usuarios_model.php";
    require_once "php/helpers/session_helper.php";
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

        public function displayIndex(){
            $this->indexview->displayIndex(isLogged(),isAdmin(),getUserSessionNombre());
        }

        private function validData($arr,$key){//funcion 'isset', seteo $arr nulo para revisar $_POST.
            if($arr==null){
                return (isset($_POST[$key])&&$_POST[$key]!='');
            }
            return (isset($arr[$key])&&$arr[$key]!='');
        }

        public function logIn(){
            if( !validData(null,'email') || !validData(null,'password') ){
                //pantalla error
                $this->displayIndex();
            }
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
            if( !validData(null,'email') || !validData(null,'password') || !validData(null,'nombre')){
                //pantalla error
                $this->displayIndex();
            }
            $nombre=$_POST['nombre'];
            $pass=$_POST['password'];
            $mail=$_POST['email'];
            $this->model->registrarUsuario($nombre,$mail,$pass);
            $this->logIn();
        }

        public function logOut(){
            finishSession();
            $this->displayIndex();
        }

        public function displayUserAdmin(){
            if (isAdmin()){
                $usuarios=$this->model->getUsuarios();
                $this->view->administrarUsuarios($usuarios);
            }
            else $this->displayIndex();
        }

        public function deleteUser($params = null){
            if(isAdmin()){
                    
                if( !validData($params,':ID') ){
                    //pantalla error
                    $this->displayIndex();
                }
                $this->model->deleteUser($params[":ID"]);
                $this->displayUserAdmin();
            }else{
               header('Location: '.BASE_URL);;
            }
        }

        public function toggleAdmin($params = null){
            if(isAdmin()){
                
                if( !validData($params,':ID') ){
                    //pantalla error
                    $this->displayIndex();
                }
                $this->model->toggleAdmin($params[":ID"]);
                $this->displayUserAdmin();
            }else{
               header('Location: '.BASE_URL);;
            }
        }


    }
