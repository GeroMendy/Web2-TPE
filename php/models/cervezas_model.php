<?php

class cervezas_model{

    private $db;
    private $tabla;

    public function __construct(){
        $this->db=new PDO('mysql:host=localhost;'.'dbname=db_mendyusunof;charset=utf8','root','');
        $this->tabla="cerveza";
    }
    public function getCervezas(){
        $select = $this->db->prepare("SELECT * FROM ".$this->tabla);
        $select->execute();
        $cervezas = $select->fetchAll(PDO::FETCH_OBJ);
        return $cervezas;
    }
    public function getCervezasSortedByEstilo(){
        $select = $this->db->prepare("SELECT * FROM ".$this->tabla." ORDER BY id_estilo DESC");
        $select->execute();
        $cervezas = $select->fetchAll(PDO::FETCH_OBJ);
        return $cervezas;
    }
    public function addCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol){
        $insert = $this->db->prepare("INSERT INTO ".$this->tabla."(nombre,imagen,id_estilo,amargor,alcohol) VALUES(?,?,?,?,?)");
        $insert->execute(array($nombre,$imagen,$id_estilo,$amargor,$alcohol));
    }
    public function updateCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol,$id_cerveza){ //Revisar código SQL. 
        $update = $this->db->prepare("UPDATE ".$this->tabla."(nombre,imagen,id_estilo,amargor,alcohol) VALUES(?,?,?,?,?) WHERE id_cerveza=?");
        $update->execute(array($nombre,$imagen,$id_estilo,$amargor,$alcohol,$id_cerveza));
    }
    public function deleteCerveza($id_cerveza){
        $delete = $this->db->prepare("DELETE FROM ".$this->tabla." WHERE id_cerveza=?");
        $delete->execute(array($id_cerveza));
    }

}

?>