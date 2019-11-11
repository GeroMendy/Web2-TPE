<?php
class cervezas_model{
    private $db;
    private $tabla;
    public function __construct(){
        $this->db=new PDO('mysql:host=localhost;'.'dbname=db_mendyusunoff;charset=utf8','root','');
        $this->tabla="cerveza";
    }
    
    public function getCervezas(){
        $select = $this->db->prepare("SELECT cerveza.*, estilo.nombre as Estilo FROM ".$this->tabla." JOIN estilo ON cerveza.id_estilo = estilo.id_estilo");
        $select->execute();
        $cervezas = $select->fetchAll(PDO::FETCH_OBJ);
        return $cervezas;
    }

    public function getCerveza($id){
        $select = $this->db->prepare("SELECT cerveza.*, estilo.nombre as Estilo FROM ".$this->tabla." JOIN estilo ON cerveza.id_estilo = estilo.id_estilo WHERE id_cerveza=?");
        $select->execute([$id]);
        $cerveza = $select->fetch(PDO::FETCH_OBJ);
        return $cerveza;
    }

    public function getCervezasByEstilo($id_estilo){
        $select = $this->db->prepare("SELECT cerveza.*, estilo.nombre as Estilo FROM ".$this->tabla." JOIN estilo ON cerveza.id_estilo = estilo.id_estilo WHERE estilo.id_estilo=?");
        $select->execute(array($id_estilo));
        $cervezas = $select->fetchAll(PDO::FETCH_OBJ);
        return $cervezas;
    }   

    public function getCervezasSortedByEstilo(){
        $select = $this->db->prepare("SELECT cerveza.*, estilo.nombre as Estilo FROM ".$this->tabla." JOIN estilo ON cerveza.id_estilo = estilo.id_estilo ORDER BY Estilo ASC");
        $select->execute();
        $cervezas = $select->fetchAll(PDO::FETCH_OBJ);
        return $cervezas;
    }

    public function addCerveza($nombre,$imagen=null,$id_estilo,$amargor,$alcohol,$imgPreload){
        if ($imagen){
            $img = $this->uploadImage($imagen);
        }else{
            $img = $imgPreload;
        }
        $insert = $this->db->prepare("INSERT INTO ".$this->tabla." (nombre,imagen,id_estilo,amargor,alcohol) VALUES(?,?,?,?,?)");
        $insert->execute(array($nombre,$img,$id_estilo,$amargor,$alcohol));
    }

    private function uploadImage($imagen){
        $nombre=uniqid() . '.jpg';
        $target ='img/cervezas/' . $nombre;
        move_uploaded_file($imagen, $target);
        return $nombre;
    }

    public function updateCerveza($nombre,$imagen=null,$id_estilo,$amargor,$alcohol,$id_cerveza,$imgPreload){ //Revisar código SQL. NO FUNCIONA
        $pathImg = null;
        if ($imagen){
            $img = $this->uploadImage($imagen);
        }else{
            $img = $imgPreload;
        }
        $update = $this->db->prepare("UPDATE ".$this->tabla." SET nombre=?, imagen=?, id_estilo=?, amargor=?, alcohol=? WHERE id_cerveza=?");
        $update->execute(array($nombre,$img,$id_estilo,$amargor,$alcohol,$id_cerveza));
    }

    public function deleteCerveza($id_cerveza){
        $delete = $this->db->prepare("DELETE FROM ".$this->tabla." WHERE id_cerveza=?");
        $delete->execute(array($id_cerveza));
    }

}
?>