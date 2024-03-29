<?php

class comentarios_model{

    private $db;
    private $table;
    private $selectBase;
    private $buscarComentarioByID;

    public function __construct(){
        $this->table = 'comentario';
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_mendyusunoff;charset=utf8','root','');
        $this->selectBase = 'SELECT '.$this->table.'.*, usuario.nombre AS usuario FROM '.$this->table.' JOIN usuario ON '.$this->table.'.id_usuario = usuario.id_usuario WHERE id_cerveza=?';
        $this->buscarComentarioByID = $this->table.' WHERE id_comentario=?';
    }

    public function getComentarios($id_cerveza){//Siempre se llama desde la pagina de una cerveza idividual.
        $select = $this->db->prepare($this->selectBase);
        $select->execute(array($id_cerveza));
        $comentarios = $select->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }
    public function getComemtariosSortedByValoracion($id_cerveza){
        $select = $this->db->prepare($this->selectBase . ' SORTED BY valoracion DESC');
        $select->execute(array($id_cerveza));
        $comentarios = $select->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }
    

    public function addComentario($id_usuario,$id_cerveza,$valoracion,$texto){
        $insert = $this->db->prepare('INSERT INTO '.$this->table.' (id_usuario,id_cerveza,valoracion,texto) VALUES (?,?,?,?)');
        $insert->execute(array($id_usuario,$id_cerveza,$valoracion,$texto));
    }/*
    public function editComentario($valoracion,$texto,$id_comentario){//La cerveza y el usuario del comentario nunca cambian.
        $update = $this->db->prepare('UPDATE '.$this->table.' SET valoracion=?, texto=? WHERE id_comentario=?');
        $update->execute(array($valoracion,$texto,$id_comentario));
    }*/
    public function deleteComentario($id_comentario){
        $delete = $this->db->prepare('DELETE FROM '.$this->buscarComentarioByID);
        $delete->execute(array($id_comentario));
    }
    public function getUserId($id_comentario){  //Para determinar si puede borrar/editar un usuario no Admin.
        $select = $this->db->prepare('SELECT id_usuario FROM '.$this->buscarComentarioByID);
        $select->execute(array($id_comentario));
        return $select->fetch(PDO::FETCH_COLUMN);
    }
    public function getCervezaId($id_comentario){   //Para redireccionar usuarios sin permiso.
        $select = $this->db->prepare('SELECT id_cerveza FROM '.$this->buscarComentarioByID);
        $select->execute(array($id_comentario));
        return $select->fetch(PDO::FETCH_COLUMN);
    }
}