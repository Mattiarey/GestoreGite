<?php
class MetaModel
{
    private $db;
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
    public function creaMeta($nome, $descrizione, $durata, $costo, $maxpart, $nomeGita)
    {

        // trova fkMeta
        // Questo è da rivedere in quanto in questo modo non ci potrebbero essere più gite con lo stesso nome
        $query = $this->db->query("SELECT id FROM mete WHERE nome = '$nomeGita'");
        $idMeta = $query->fetch(PDO::FETCH_OBJ);

        // crea meta
        $query = "INSERT INTO tour(nome, descrizione, durata, costo, fkMeta, maxPart) VALUES (:nome, :descrizione, :durata, :costo, :fkMeta, :maxPart)";
        $statement = $this->db->prepare($query);

        $statement->bindParam(':nome', $nome);
        $statement->bindParam(':descrizione', $descrizione);
        $statement->bindParam(':durata', $durata);
        $statement->bindParam(':costo', $costo);
        $statement->bindParam(':fkMeta', $idMeta->id);
        $statement->bindParam(':maxPart', $maxpart);

        $statement->execute();

        header("Location: ../View/homepage.html", true);
        exit();
    }
    public function eliminaMeta($id)
    {
        // elimina meta
        $query = "DELETE FROM tour WHERE id = $id";
        $statement = $this->db->prepare($query);
        $statement->execute();

        $query = "DELETE FROM possonovedere WHERE fkTour = $id;";
        $statement = $this->db->prepare($query);
        $statement->execute();
    }
    public function mostraMetina($id){
        $conn = new mysqli("localhost", "root", "", "gite");
        $query = "SELECT * FROM tour WHERE id = $id";
        $result = $conn->query($query);
        $gite = [];
            if ($result->num_rows > 0) {
                while ($gita = $result->fetch_assoc()) {
                    $gite[] = $gita;
                }

            }
        return json_encode($gite);
    }
    public function modificaMeta($id, $new_nome, $new_descrizione, $new_durata, $new_costo, $new_maxPart)
    {


        // Query di aggiornamento
        $query = "UPDATE tour SET nome = '$new_nome', descrizione = '$new_descrizione', durata = '$new_durata', costo = '$new_costo', maxPart = '$new_maxPart' WHERE id = $id";
        $statement = $this->db->prepare($query);
        $statement->execute();
        header("Location: ../View/modificaTour.html", true);
        exit();
    }
}