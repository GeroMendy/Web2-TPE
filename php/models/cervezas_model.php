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

    public function addCerveza($nombre,$id_estilo,$amargor,$alcohol){
        $dir=uniqid();
        mkdir('img/cervezas/' . $dir);
        $insert = $this->db->prepare("INSERT INTO ".$this->tabla." (nombre,imagen,id_estilo,amargor,alcohol) VALUES(?,?,?,?,?)");
        $insert->execute(array($nombre,$dir,$id_estilo,$amargor,$alcohol));
    }

    public function updateCerveza($nombre,$id_estilo,$amargor,$alcohol,$id_cerveza){
        $update = $this->db->prepare("UPDATE ".$this->tabla." SET nombre=?, id_estilo=?, amargor=?, alcohol=? WHERE id_cerveza=?");
        $update->execute(array($nombre,$id_estilo,$amargor,$alcohol,$id_cerveza));
    }

    public function deleteCerveza($id_cerveza){
        $this->rrmdir("img/cervezas/".$this->getCerveza($id_cerveza)->imagen);
        $delete = $this->db->prepare("DELETE FROM ".$this->tabla." WHERE id_cerveza=?");
        $delete->execute(array($id_cerveza));
        
    }
    public function deleteImg($id,$img){
        $arch='img/cervezas/'.$this->getCerveza($id)->imagen."/".$img;
        if ( file_exists($arch) ) { 
            unlink($arch);
        }
    }

    public function subirImgs($id,$imagenes){
            $dir="img/cervezas/".$this->getCerveza($id)->imagen."/";
            foreach ($imagenes as $imagen) {
              $destino_final = $dir . uniqid() . '.jpg';
              move_uploaded_file($imagen, $destino_final);
            }
    }

    private function rrmdir($dir) {
        if (is_dir($dir)) {
          $objects = scandir($dir);
          foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
              if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
            }
          }
          reset($objects);
          rmdir($dir);
        }
     } 
}
?>