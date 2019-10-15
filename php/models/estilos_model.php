<?php

class estilos_model{

    private $db;
    private $tabla;

    public function __construct(){
        $this->db=new PDO('mysql:host=localhost;'.'dbname=db_mendyusunoff;charset=utf8','root','');
        $this->tabla="estilo";
    }

    public function getEstilos(){
        $select = $this->db->prepare("SELECT * FROM ".$this->tabla);
        $select->execute();
        $estilos = $select->fetchAll(PDO::FETCH_OBJ);
        return $estilos;
    }
    public function addEstilo($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max){
        $insert = $this->db->prepare("INSERT INTO ".$this->tabla."(nombre,color,aroma,apariencia,sabor,amargor_min,amargor_max,alcohol_min,alcohol_max) VALUES(?,?,?,?,?,?,?,?,?)");
        $insert->execute(array($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max));
    }
    public function updateEstilo($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max,$id_estilo){ //Revisar código SQL. 
        $update = $this->db->prepare("UPDATE ".$this->tabla."nombre,color,aroma,apariencia,sabor,amargor_min,amargor_max,alcohol_min,alcohol_max) VALUES(?,?,?,?,?,?,?,?,?) WHERE id_estilo=?");
        $update->execute(array($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max,$id_estilo));
    }
    public function deleteEstilo($id_estilo){
        $delete = $this->db->prepare("DELETE FROM ".$this->tabla." WHERE id_estilo=?");
        $delete->execute(array($id_estilo));
    }
}

?>