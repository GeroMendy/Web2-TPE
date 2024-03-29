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

    public function getEstilo($id){
        $select = $this->db->prepare("SELECT * FROM ".$this->tabla." WHERE id_estilo=?");
        $select->execute([$id]);
        $estilo = $select->fetch(PDO::FETCH_OBJ);
        return $estilo;
    }

    public function getIdEstilo($estilo){   //Trae el id según String de estilo
        $select = $this->db->prepare("SELECT id_estilo FROM ".$this->tabla." WHERE nombre=?");
        $select->execute([$estilo]);
        $estilo = $select->fetch(PDO::FETCH_OBJ);
        return $estilo->id_estilo;
    }

    public function addEstilo($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max){
        $insert = $this->db->prepare("INSERT INTO ".$this->tabla."(nombre,color,aroma,apariencia,sabor,amargor_min,amargor_max,alcohol_min,alcohol_max) VALUES(?,?,?,?,?,?,?,?,?)");
        $insert->execute(array($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max));
    }
    public function updateEstilo($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max,$id_estilo){ //NO FUNCIONA!!! . Revisar código SQL. 
        $update = $this->db->prepare("UPDATE ".$this->tabla." SET nombre=?, color=?, aroma=?, apariencia=?, sabor=?, amargor_min=?, amargor_max=?, alcohol_min=?, alcohol_max=? WHERE id_estilo=?");
        $update->execute(array($nombre,$color,$aroma,$apariencia,$sabor,$amargor_min,$amargor_max,$alcohol_min,$alcohol_max,$id_estilo));
    }
    public function deleteEstilo($id_estilo){
        $delete = $this->db->prepare("DELETE FROM ".$this->tabla." WHERE id_estilo=?");
        $delete->execute(array($id_estilo));
    }

    public function getNombre($id_estilo){
        $select = $this->db->prepare("SELECT nombre FROM ".$this->tabla." WHERE id_estilo=?");
        $select->execute(array($id_estilo));
        $estilo = $select->fetch(PDO::FETCH_COLUMN); //REVISAR.
        return $estilo;
    }
}

?>