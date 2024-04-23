<?php
class GitaModel
{
    private $db;
    public function __construct()
    {
        // Connessione al database
        $this->db = new PDO('mysql:host=localhost;dbname=Gite', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // funzione freccia molto carina per avere l'id utente
    // lo use si usa perché le arrow function non possono usare this altrimenti
    private $idUtente = fn($db) => function () use ($db) {
            try {
                $emailUtente = $_COOKIE['UserConnesso'];

                $query = $db->prepare("SELECT id FROM utenti WHERE email = :email");
                $query->execute(['email' => $emailUtente]);
                $idU = $query->fetch(PDO::FETCH_OBJ);

                return $idU->id;
            } catch (PDOException $e) {
                return "Errore nella ricerca dell'id Utente";
            }
        };
    public function creaGita($nome, $descrizione, $data, $costo, $maxpart)
    {
        try {
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

            $statement->bindParam(':fu', $this->idUtente);
            $statement->bindParam(':fm', $idMeta->id);

            $statement->execute();
        } catch (PDOException $e) {

        }
    }
    public function eliminaGita($nome, $data)
    {
        $creatore = (string)$this->idUtente;
        try {
            //trova id meta
            $query = $this->db->query("SELECT id FROM mete WHERE nome = '$nome' AND data = '$data'");
            $idMeta = $query->fetch(PDO::FETCH_OBJ);
            //elimina gita
            $query = "DELETE FROM gita WHERE fkUtenti = '$creatore' AND fkmete = '$idMeta'";
            $statement = $this->db->prepare($query);
            $statement->execute();
            //elimina meta
            $query = "DELETE FROM mete WHERE nome = '$nome' AND data = '$data'";
            $statement = $this->db->prepare($query);
            $statement->execute();
        } catch (PDOException $e) {
            
        }
    }
}
/*
$query = "DELETE FROM utenti WHERE email = :email AND password = :password";
            $statement = $this->db->prepare($query);

            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);

            $statement->execute();
*/