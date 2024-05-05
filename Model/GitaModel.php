<?php
require_once ("class/gitameta.php");
class GitaModel
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
        $creatore = (string) $this->idUtente;
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
    public function prendiGita()
    {
        $gite = [];

        $meteDelBro = [];
        // prendere tutte le mete dell'utente connesso

        $conn = new mysqli("localhost", "root", "", "gite");
        $sql = "SELECT fkMete FROM gita WHERE fkUtenti = '$this->idUtente'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $meteDelBro[] = $row['fkMete'];
            }
        }


        //prendere mete della gita

        // lunghezza coso
        $lughezza = count((array) $meteDelBro);

        for ($i = 0; $i < $lughezza; $i++) {
            $idMeta = $meteDelBro[$i];
            $query = $this->db->query("SELECT * FROM mete WHERE id = '$idMeta'");
            $giteVarie = $query->fetch(PDO::FETCH_OBJ);

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