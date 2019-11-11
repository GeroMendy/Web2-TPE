<?php

    class usuarios_model{

        private $db;
        private $tabla;

        public function __construct(){

            $this->db=new PDO('mysql:host=localhost;'.'dbname=db_mendyusunoff;charset=utf8','root','');
            $this->tabla="usuario";

        }

        public function getUsuario($mail){
            $select = $this->db->prepare("SELECT * FROM ".$this->tabla." WHERE mail=?");
            $select->execute(array($mail));
            $usuario = $select->fetch(PDO::FETCH_OBJ);
            return $usuario;
        }

        public function getUsuarios(){
            $select = $this->db->prepare("SELECT * FROM ".$this->tabla);
            $select->execute();
            $usuarios = $select->fetchAll(PDO::FETCH_OBJ);
            return $usuarios;
        }

        public function deleteUser($id){
            $delete = $this->db->prepare("DELETE FROM ".$this->tabla." WHERE id_usuario=?");
            $delete->execute(array($id));
        }

        public function registrarUsuario($nombre,$mail,$password){
            //password se vuelve password_encriptada
            $password = md5($password);

            $insert = $this->db->prepare("INSERT INTO ".$this->tabla."(nombre,mail,password,admin) VALUES (?,?,?,?)");
            $insert->execute(array($nombre,$mail,$password,0));
        }

        public function toggleAdmin($id){
            $get=$this->db->prepare("SELECT admin FROM ".$this->tabla." WHERE id_usuario=?");
            $get->execute(array($id));
            $actual=$get->fetch(PDO::FETCH_OBJ);
            $admin= !$actual->admin;
            $update = $this->db->prepare("UPDATE ".$this->tabla." SET admin=? WHERE id_usuario=?");
            $update->execute(array($admin, $id));
        }
        

    }

?>