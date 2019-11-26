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

    public function getComentarios($id_cerveza,$sort,$order){//Siempre se llama desde la pagina de una cerveza idividual.
        $arr = array($id_cerveza);
        $sql = $this->selectBase;
        if($sort!=''){
            $sql .= " SORTED BY ?";
            array_push($arr,$sort);
        }
        if ($order!='') {
            $sql .= " ORDER ?";
            array_push($arr,$order);
        }
        $select = $this->db->prepare($sql);
        $select->execute($arr);
        $comentarios = $select->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }

    public function addComentario($id_usuario,$id_cerveza,$valoracion,$texto){
        $insert = $this->db->prepare('INSERT INTO '.$this->table.' (id_usuario,id_cerveza,valoracion,texto,fecha) VALUES (?,?,?,?,?)');
        $insert->execute(array($id_usuario,$id_cerveza,$valoracion,$texto,getSQLDate()));
    }
    public function editComentario($valoracion,$texto,$id_comentario){//La cerveza y el usuario del comentario nunca cambian.
        $update = $this->db->prepare('UPDATE '.$this->table.' SET valoracion=?, texto=?, fecha=? WHERE id_comentario=?');
        $update->execute(array($valoracion,$texto,getdate(),$id_comentario));
    }
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
    public function getSQLDate(){
        $date = getdate();
        var_dump($date);
        echo "</br>";
        $date = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
        var_dump($date);
        echo "</br>";
        $sql = $this->db->prepare('SELECT CONVERT(datetime,'.$date.',120)');
        var_dump($sql);
        echo "</br>";
        $date = $sql->execute();
        var_dump($date);
        echo "</br>";
        return $date;
    }


}