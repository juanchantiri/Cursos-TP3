<?php

class auth_model{

        private $db;

    public function __construct() {
        $this->db =  new PDO('mysql:host=localhost;dbname=db_cursos;charset=utf8', 'root', '');
    }

    public function getUserByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE email = ?');
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        
        return $user;
    }

    public function createUser($email, $password, $rol = 'user') {
        $query = $this->db->prepare('INSERT INTO usuario (email, password, rol) VALUES (?, ?, ?)');
        $query->execute([$email, $password, $rol]);
    }
}