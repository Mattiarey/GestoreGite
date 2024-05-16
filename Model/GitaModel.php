
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
    public function creaGita($nome, $descrizione, $data, $costo)
    {
        try {
            // crea meta
            $query = "INSERT INTO mete(nome, descrizione, data, costo) VALUES (:nome, :descrizione, :data, :costo)";
            $statement = $this->db->prepare($query);

            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':descrizione', $descrizione);
            $statement->bindParam(':data', $data);
            $statement->bindParam(':costo', $costo);

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

            header("Location: ../View/homepage.html", true);
            exit();
        } catch (PDOException $e) {

        }
    }
    public function eliminaGita($id)
    {
        $query = "DELETE FROM gita WHERE fkMete = $id;";
        $statement = $this->db->prepare($query);
        $statement->execute();

        $query = "DELETE FROM mete WHERE id = $id;";
        $statement = $this->db->prepare($query);
        $statement->execute();

    }
    // funzione ottimizzabile ma funzionante
    // forse potevo fare semplicemente dei join nelle query -_-
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
            // prendi tutte le mete
            $idMeta = $meteDelBro[$i];
            $query = $this->db->query("SELECT * FROM mete WHERE id = '$idMeta'");
            $gite[] = $query->fetch(PDO::FETCH_OBJ);

        }
        // questo array contiene un array che contiene i tour per meta
        $tourPerMeta = array();
        for ($i = 0; $i < $lughezza; $i++) {
            // prendi tutti i tour
            $fkMeta = $meteDelBro[$i];
            $query = $this->db->query("SELECT * FROM tour WHERE fkMeta = '$fkMeta'");
            $tour = $query->fetch(PDO::FETCH_OBJ);

            $conn = new mysqli("localhost", "root", "", "gite");
            $sql = "SELECT * FROM tour WHERE fkMeta = '$fkMeta'";
            $result = $conn->query($sql);


            $tourVari = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tour = $row;
                    $tourVari[] = new Tour($tour['id'], $tour['nome'], $tour['descrizione'], $tour['durata'], $tour['costo'], $tour['fkMeta'], $tour['maxPart'], $tour['partAttuali']);
                }

            }
            $tourPerMeta[] = $tourVari;

        }
        $veraGita = array();
        // riempi classi
        for ($i = 0; $i < count((array) $gite); $i++) {
            // tanto dovrebbero essere array paralleli
            $veraGita[] = new Gitameta($gite[$i]->id, $gite[$i]->nome, $gite[$i]->descrizione, $gite[$i]->data, $gite[$i]->costo, $tourPerMeta[$i]);
        }
        return $veraGita;

    }
    function rubaGite()
    {
        $gite = [];

        $meteDelBro = [];
        // prendere tutte le mete a cui partecipa l'utente

        $conn = new mysqli("localhost", "root", "", "gite");
        $sql = "SELECT fkGita FROM possonovedere WHERE fkUtente = '$this->idUtente'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $meteDelBro[] = $row['fkGita'];
            }
        }
        $meteDelBro = array_values(array_unique($meteDelBro));

        //prendere mete della gita

        // lunghezza coso
        $lughezza = count((array) $meteDelBro);

        for ($i = 0; $i < $lughezza; $i++) {
            // prendi tutte le mete
            $idMeta = $meteDelBro[$i];
            $query = $this->db->query("SELECT * FROM mete WHERE id = '$idMeta'");
            $gite[] = $query->fetch(PDO::FETCH_OBJ);

        }
        // questo array contiene un array che contiene i tour per meta
        $tourPerMeta = array();
        for ($i = 0; $i < $lughezza; $i++) {
            // prendi tutti i tour
            $fkMeta = $meteDelBro[$i];
            $query = $this->db->query("SELECT * FROM tour WHERE fkMeta = '$fkMeta'");
            $tour = $query->fetch(PDO::FETCH_OBJ);

            $conn = new mysqli("localhost", "root", "", "gite");
            $sql = "SELECT * FROM tour WHERE fkMeta = '$fkMeta'";
            $result = $conn->query($sql);


            $tourVari = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tour = $row;
                    $tourVari[] = new Tour($tour['id'], $tour['nome'], $tour['descrizione'], $tour['durata'], $tour['costo'], $tour['fkMeta'], $tour['maxPart'], $tour['partAttuali']);
                }

            }
            $tourPerMeta[] = $tourVari;

        }
        $veraGita = array();
        // riempi classi
        for ($i = 0; $i < count((array) $gite); $i++) {
            // tanto dovrebbero essere array paralleli
            $veraGita[] = new Gitameta($gite[$i]->id, $gite[$i]->nome, $gite[$i]->descrizione, $gite[$i]->data, $gite[$i]->costo, $tourPerMeta[$i]);
        }
        return $veraGita;
    }
    public function sonoAdmin()
    {
        $gite = [];

        $meteDelBro = [];
        // prendere tutte le mete

        $conn = new mysqli("localhost", "root", "", "gite");
        $sql = "SELECT fkMete FROM gita";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $meteDelBro[] = $row['fkMete'];
            }
        }
        $meteDelBro = array_values(array_unique($meteDelBro));

        //prendere mete della gita

        // lunghezza coso
        $lughezza = count((array) $meteDelBro);

        for ($i = 0; $i < $lughezza; $i++) {
            // prendi tutte le mete
            $idMeta = $meteDelBro[$i];
            $query = $this->db->query("SELECT * FROM mete WHERE id = '$idMeta'");
            $gite[] = $query->fetch(PDO::FETCH_OBJ);

        }
        // questo array contiene un array che contiene i tour per meta
        $tourPerMeta = array();
        for ($i = 0; $i < $lughezza; $i++) {
            // prendi tutti i tour
            $fkMeta = $meteDelBro[$i];
            $query = $this->db->query("SELECT * FROM tour WHERE fkMeta = '$fkMeta'");
            $tour = $query->fetch(PDO::FETCH_OBJ);

            $conn = new mysqli("localhost", "root", "", "gite");
            $sql = "SELECT * FROM tour WHERE fkMeta = '$fkMeta'";
            $result = $conn->query($sql);


            $tourVari = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tour = $row;
                    $tourVari[] = new Tour($tour['id'], $tour['nome'], $tour['descrizione'], $tour['durata'], $tour['costo'], $tour['fkMeta'], $tour['maxPart'], $tour['partAttuali']);
                }

            }
            $tourPerMeta[] = $tourVari;

        }
        $veraGita = array();
        // riempi classi
        for ($i = 0; $i < count((array) $gite); $i++) {
            // tanto dovrebbero essere array paralleli
            $veraGita[] = new Gitameta($gite[$i]->id, $gite[$i]->nome, $gite[$i]->descrizione, $gite[$i]->data, $gite[$i]->costo, $tourPerMeta[$i]);
        }
        return $veraGita;

    }

}
/*
SELECT * FROM possonovedere
INNER JOIN mete on (mete.id = possonovedere.fkGita)
INNER JOIN tour on (tour.id = possonovedere.fkTour)
WHERE possonovedere.fkUtente = 90;*/
/*
$query = "DELETE FROM utenti WHERE email = :email AND password = :password";
            $statement = $this->db->prepare($query);

            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);

            $statement->execute();
*/