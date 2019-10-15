<?php

    class usuarios_model{

        private $db;
        private $tabla;

        public function __construct(){

            $this->db=new PDO('mysql:host=localhost;'.'dbname=db_mendyusunoff;charset=utf8','root','');
            $this->tabla="usuario";

        }
        
        /*
        public function getUsuarioByNombre($nombre){
            $select = $this->db->prepare("SELECT * FROM ".$this->tabla." WHERE nombre=?");
            $select->execute(array($nombre));
            $usuario = $select->fetch(PDO::FETCH_OBJ);
            return $usuario;
        }
        */

        public function getUsuarioByMail($mail){
            $select = $this->db->prepare("SELECT * FROM ".$this->tabla." WHERE mail=?");
            $select->execute(array($mail));
            $usuario = $select->fetch(PDO::FETCH_OBJ);
            return $usuario;
        }

    }

?>