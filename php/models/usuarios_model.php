<?php

    class usuarios_model{

        private $db;
        private $tabla;

        public function __construct(){

            $this->db=new PDO('mysql:host=localhost;'.'dbname=db_mendyusunof;charset=utf8','root','');
            $this->tabla="usuario";

        }

        public function getUsuario($mail){
            $select = $this->db->prepare("SELECT * FROM ".$this->tabla." WHERE mail=?");
            $select->execute(array($mail));
            $usuario = $select->fetch(PDO::FETCH_OBJ);
            return $usuario;
        }
        public function registrarUsuario($nombre,$mail,$password,$admin){

            //password se vuelve password_encriptada
            $password = md5($password);

            $insert = $this->db->prepare("INSERT INTO ".$this->tabla."(nombre,mail,password,admin) VALUES (?,?,?,?)");
            $insert->execute(array($nombre,$mail,$password,$admin));
        }

    }

?>