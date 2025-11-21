<?php


class cursos_model{


    function connect(){    
    $db = new PDO('mysql:host=localhost;dbname=db_cursos;charset=utf8', 'root', '');
    return $db;
    }

    function getAll(){
        $db= $this->connect();
        $query = $db->prepare('SELECT * FROM curso');
        $query->execute([]);
        $curso = $query->fetchAll(PDO::FETCH_OBJ);
        return $curso;
    }




    
    function añadirCursos($titulo, $descripcion,$instructor, $imagen, $id_categoria){
        $db = $this->connect();
        $query = $db->prepare("INSERT INTO curso(titulo, descripcion, instructor, imagen, id_categoria) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$titulo, $descripcion,$instructor, $imagen, $id_categoria]);
        return $db->lastInsertId();
    }

    function getCursosByCategoria($id_categoria) {
    $db = $this->connect();
    
    $query = $db->prepare("SELECT c.*, cat.nombre AS nombre_categoria FROM curso c JOIN categoria cat ON c.id_categoria = cat.id WHERE c.id_categoria = ?");

    $query->execute([$id_categoria]);
    
    return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function eliminarCurso($id){
        $db = $this->connect();
        $query = $db->prepare("DELETE FROM curso WHERE id = ?");
        $query->execute([$id]);
        return;
    }

    public function curso($id) {
        $db = $this->connect();
        $query = $db->prepare('SELECT * FROM curso WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function updateCurso($id, $titulo, $descripcion, $instructor, $id_categoria, $imagenUrl) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE curso SET titulo = ?, descripcion = ?, instructor = ?, id_categoria = ?, imagen = ? WHERE id = ?");
        $query->execute([$titulo, $descripcion, $instructor, $id_categoria, $imagenUrl, $id]);
    }
}