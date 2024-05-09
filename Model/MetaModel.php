<?php
class MetaModel{private $db;
    private $idUtente;
    public function __construct()
    {
        // Connessione al database
        $this->db = new PDO('mysql:host=localhost;dbname=Gite', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prendi id utente
        $emailUtente = $_COOKIE['UserConnesso'];

        $query = $this->db->prepare("SELECT id FROM utenti WHERE email = :email");
        $query->execute(['email' => $emailUtente]);
        $idU = $query->fetch(PDO::FETCH_OBJ);
        $this->idUtente = $idU->id;
    }
    public function creaMeta($nome, $descrizione, $durata, $costo, $maxpart, $nomeGita){

    }
}