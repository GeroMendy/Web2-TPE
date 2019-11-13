<?php

class comentarios_model{

    private $db;
    private $table;

    public function __construct(){
        $this->table = 'comentario';
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_mendyusunoff;charset=utf8','root','');
    }

    public function getComentarios($id_cerveza){  //Siempre se llama desde la pagina de una cerveza idividual.
        $select = $this->db->prepare('SELECT '.$this->table.'*, usuario.nombre AS usuario JOIN usuario ON '.$this->table.'.id_usuario = usuario.id_usuario WHERE id_cerveza=?');
        $select->execute(array($id_cerveza));
        return $select->fetchAll(PDO::FETCH_OBJ);
    }
    public function addComentario($id_usuario,$id_cerveza,$valoracion,$texto){
        $insert = $this->db->prepare('INSERT INTO '.$this->table.' (id_usuario,id_cerveza,valoracion,texto) VALUES (?,?,?,?)');
        $insert->execute(array($id_usuario,$id_cerveza,$valoracion,$texto));
    }
    public function editComentario($valoracion,$texto,$id_comentario){//La cerveza y el usuario del comentario nunca cambian.
        $update = $this->db->prepare('UPDATE '.$this->table.' SET valoracion=?, texto=? WHERE id_comentario=?');
        $update->execute(array($valoracion,$texto,$id_comentario));
    }
    public function deleteComentario($id_comentario){
        $delete = $this->db->prepare('DELETE FROM '.$this->table.' WHERE id_comentario=?');
        $delete->execute(array($id_comentario));
    }
    public function getUserId($id_comentario){
        $select = $this->db->prepare('SELECT id_usuario FROM '.$this->table.' WHERE id_comentario=?');
        $select->execute(array($id_comentario));
        return $select->fetch(PDO::FETCH_COLUMN);
    }
}