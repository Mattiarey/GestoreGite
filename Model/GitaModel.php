<?php
// forse questa cosa potrei metterla dentro UserModel, ma così è più carino ed ordinato
class GitaModel
{
    private $db;
    public function __construct()
    {
        // Connessione al database
        $this->db = new PDO('mysql:host=localhost;dbname=Gite', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function creaGita($nome, $descrizione, $data, $costo, $maxpart)
    {
        // trova id utente attuale
        $nomeUtenti = $_COOKIE['UserConnesso'];
        $query = $this->db->query("SELECT id FROM utenti WHERE nome = '$nomeUtenti'");
        $idUtente = $query->fetch(PDO::FETCH_OBJ); 

        // crea meta
        $query = "INSERT INTO mete(nome, descrizione, data, costo, massimoPartecipanti) VALUES (:nome, :descrizione, :data, :costo, :massimoPartecipanti)";
        $statement = $this->db->prepare($query);

        $statement->bindParam(':nome', $nome);
        $statement->bindParam(':descrizione', $descrizione);
        $statement->bindParam(':data', $data);
        $statement->bindParam(':costo', $costo);
        $statement->bindParam(':massimoPartecipanti', $maxpart);

        $statement->execute();

        // trova idMeta
        $query = $this->db->query("SELECT id FROM mete WHERE nome = '$nome' AND data = '$data'");
        $idMeta = $query->fetch(PDO::FETCH_OBJ);


        // collega gita
        $query = "INSERT INTO gita (fkMete, fkUtenti) VALUES (:fm, :fu)";
        $statement = $this->db->prepare($query);

        $statement->bindParam(':fu', $idUtente->id);
        $statement->bindParam(':fm', $idMeta->id);

        $statement->execute();
    }
}