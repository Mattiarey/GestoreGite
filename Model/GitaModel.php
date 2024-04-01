<?php
// forse questa cosa potrei metterla dentro UserModel, ma così è più carino ed ordinato
class GitaModel{
    private $db;
    public function __construct(){
        // Connessione al database
        $this->db = new PDO('mysql:host=localhost;dbname=Gite', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function creaGita(){
        
    }
}