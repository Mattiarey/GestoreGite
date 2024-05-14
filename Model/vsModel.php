<?php
class VsModel
{
    private $db;
    private $idUtente;
    public function __construct($mail)
    {
        // Connessione al database
        $this->db = new PDO('mysql:host=localhost;dbname=Gite', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $this->db->prepare("SELECT id FROM utenti WHERE email = :email");
        $query->execute(['email' => $mail]);
        $idU = $query->fetch(PDO::FETCH_OBJ);
        $this->idUtente = $idU->id;
    }
    public function aggiungiTizio($idTour)
    {
        // trovare fkmeta del tour
        $query = $this->db->prepare("SELECT fkMeta FROM tour WHERE id = :id");
        $query->execute(['id' => $idTour]);
        $fkM = $query->fetch(PDO::FETCH_OBJ);
        $fkMeta = $fkM->fkMeta;

        // aggiungere fkMeta, idUtente, idMeta alla tabella possonovedere

        $query = "INSERT INTO possonovedere(fkUtente, fkGita, fkTour) VALUES (:fkUtente, :fkGita, :fkTour)";
        $statement = $this->db->prepare($query);

        $statement->bindParam(':fkUtente', $this->idUtente);
        $statement->bindParam(':fkGita', $fkMeta);
        $statement->bindParam(':fkTour', $idTour);

        $statement->execute();


        // aggiungere 1 ai partecipanti della tabella tours 
        $query = $this->db->prepare("UPDATE tour SET partAttuali = partAttuali + 1 WHERE id = '$idTour'");
        $query-> execute();

    }
}