<?php
class cervezas_model{
    private $db;
    private $tabla;
    private $tabla_img;
    private $img_dir;

    public function __construct(){
        $this->db=new PDO('mysql:host=localhost;'.'dbname=db_mendyusunoff;charset=utf8','root','');
        $this->img_dir="img/cervezas/";
        $this->tabla="cerveza";
        $this->tabla_img="imagen";
    }
    
    public function getCervezas(){
        $select = $this->db->prepare("SELECT cerveza.*, estilo.nombre as Estilo FROM ".$this->tabla." JOIN estilo ON cerveza.id_estilo = estilo.id_estilo");
        $select->execute();
        $cervezas = $select->fetchAll(PDO::FETCH_OBJ);
        $this->fetchImg($cervezas);
        return $cervezas;
    }

    public function getCerveza($id){
        $select = $this->db->prepare("SELECT cerveza.*, estilo.nombre as Estilo FROM ".$this->tabla." JOIN estilo ON cerveza.id_estilo = estilo.id_estilo WHERE id_cerveza=?");
        $select->execute(array($id));
        $cerveza = $select->fetch(PDO::FETCH_OBJ);
        $imgQuery=$this->db->prepare("SELECT archivo FROM " .$this->tabla_img. " WHERE id_cerveza=?");
        $imgQuery->execute(array($id));  //Suma al objeto cerveza las imágenes fetcheadas de la tabla imagen
        $imagenes = $imgQuery->fetchAll(PDO::FETCH_OBJ);
        $cerveza->imagenes=$imagenes;
        return $cerveza;
    }

    public function getCervezasByEstilo($id_estilo){
        $select = $this->db->prepare("SELECT cerveza.*, estilo.nombre as Estilo FROM ".$this->tabla." JOIN estilo ON cerveza.id_estilo = estilo.id_estilo WHERE estilo.id_estilo=?");
        $select->execute(array($id_estilo));
        $cervezas = $select->fetchAll(PDO::FETCH_OBJ);
        $this->fetchImg($cervezas);
        return $cervezas;
    }   

    public function getCervezasSortedByEstilo(){
        $select = $this->db->prepare("SELECT cerveza.*, estilo.nombre as Estilo FROM ".$this->tabla." JOIN estilo ON cerveza.id_estilo = estilo.id_estilo ORDER BY Estilo ASC");
        $select->execute();
        $cervezas = $select->fetchAll(PDO::FETCH_OBJ);
        $this->fetchImg($cervezas);
        return $cervezas;
    }

    private function fetchImg($cervezas){//Adjunta a cada cerveza un atributo imagen con la primera imagen asociada al id en la tabla imagen
        foreach($cervezas as $cerve){
            $imgQuery=$this->db->prepare("SELECT archivo FROM " .$this->tabla_img. " WHERE id_cerveza=?");
            $imgQuery->execute(array($cerve->id_cerveza));
            $imagen = $imgQuery->fetch(PDO::FETCH_OBJ);
            if ($imagen)
                $cerve->imagen=$imagen->archivo;
            else
            $cerve->imagen="";
        }
    }

    public function addCerveza($nombre,$id_estilo,$amargor,$alcohol){
        $insert = $this->db->prepare("INSERT INTO ".$this->tabla." (nombre,id_estilo,amargor,alcohol) VALUES(?,?,?,?)");
        $insert->execute(array($nombre,$id_estilo,$amargor,$alcohol));
        $id=$this->db->lastInsertId();
        $this->addImagenes($id); 
    }

    public function updateCerveza($nombre,$id_estilo,$amargor,$alcohol,$id_cerveza){
        $update = $this->db->prepare("UPDATE ".$this->tabla." SET nombre=?, id_estilo=?, amargor=?, alcohol=? WHERE id_cerveza=?");
        $update->execute(array($nombre,$id_estilo,$amargor,$alcohol,$id_cerveza));
        $this->addImagenes($id_cerveza);
    }
    private function addImagenes($id_cerveza){
        if (($_FILES["imagesToUpload"]["size"][0] !=0)){//hay otra forma mejor de hacerlo?
            $imagenes=$_FILES["imagesToUpload"]["tmp_name"];
            $nombres=$_FILES["imagesToUpload"]["name"];
            $sentencia_img= $this->db->prepare("INSERT INTO ".$this->tabla_img." (archivo,id_cerveza) VALUES(?,?)");
            foreach($imagenes as $key=>$tmp_name){   
                $uid=(string) uniqid(random_int(0,255)) . $nombres[$key];
                $destino = $this->img_dir . $uid;
                move_uploaded_file($tmp_name,$destino);
                $sentencia_img->execute([$uid,$id_cerveza]);
            }
        }
    }

    public function deleteCerveza($id_cerveza){
        $this->deleteAllImgs($id_cerveza); //Elimina todas las imagenes asociadas.
        $this->deleteAllComments($id_cerveza);//Elimina todos los comentarios asociados.
        $delete = $this->db->prepare("DELETE FROM ".$this->tabla." WHERE id_cerveza=?");
        $delete->execute(array($id_cerveza));

    }
    private function deleteAllImgs($id_cerveza){
        $imgQuery=$this->db->prepare("SELECT archivo FROM " .$this->tabla_img. " WHERE id_cerveza=?");
        $imgQuery->execute(array($id_cerveza));
        $imagenes = $imgQuery->fetchAll(PDO::FETCH_OBJ);
        foreach ($imagenes as $img){
            $this->deleteImagen($id_cerveza,$img->archivo);
        }
    }
    private function deleteAllComments($id_cerveza){
        $delete = $this->db->prepare("DELETE FROM comentario WHERE id_cerveza=?");
        $delete->execute(array($id_cerveza));
    }

    public function deleteImagen($id,$img){
        $arch=$this->img_dir . $img;
        if (file_exists($arch))
             unlink($arch);
        $delete = $this->db->prepare("DELETE FROM ".$this->tabla_img." WHERE (archivo=? AND id_cerveza=?)");
        $delete->execute(array($img,$id));
    }

}
?>