<?php
class UserModel {
    private $db;
    public function __construct() {
        // Connessione al database
        $this->db = new PDO('mysql:host=localhost;dbname=Gite', 'root', '');
    }
    public function getUsers() {
        $query = $this->db->query('SELECT * FROM utente');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}