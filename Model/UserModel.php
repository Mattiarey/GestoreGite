<?php
/*
    Non funziona l'eco in questa pagina, dovrei reindirizzarlo come risultato del metodo
*/
class UserModel
{
    private $db;
    public function __construct()
    {
        // Connessione al database
        $this->db = new PDO('mysql:host=localhost;dbname=Gite', 'root', '');
        // errori vari
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getUsers()
    {
        $query = $this->db->query('SELECT * FROM utenti');
        return $query->fetchAll(PDO::FETCH_ASSOC);
        // PDO::FETCH_ASSOC è una costante della classe PDO, indica che ogni riga viene restituita 
        // come dizionario
        // :: si usa per accedere a metodi e attributi statici
    }
    public function createUser($nome, $cognome, $email, $password, $isAdmin = false)
    {
        try {
            // Usare i placeholder per preparare la query
            $query = "INSERT INTO utenti(nome, cognome, email, password, isAdmin) VALUES (:nome, :cognome, :email, :password, :isAdmin)";
            $statement = $this->db->prepare($query);

            // Placeholder vari
            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':cognome', $cognome);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':isAdmin', $isAdmin, PDO::PARAM_BOOL); // Booleano

            // Fare coso
            $statement->execute();

            echo "<script>console.log('Record creato');</script>";
            setcookie('UserConnesso', $email, time() + (86400 * 30), "/");
            // serve toglierlo quando si fa il logout? oppure basta sovrascriverlo
            header("https://google.com", true);
            exit();
        } catch (PDOException $e) {
            echo "<script>console.log('Error: " . $e->getMessage() . "');</script>";
        }
    }
    public function eliminaUser($email, $password)
    {
        try {
            $query = "DELETE FROM utenti WHERE email = :email AND password = :password";
            $statement = $this->db->prepare($query);

            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);

            $statement->execute();
            echo "<script>console.log('Utente cancellato');</script>";
        } catch (PDOException $e) {
            echo "<script>console.log('Error: " . $e->getMessage() . "');</script>";
        }
    }
    public function checkUser($email, $password)
    {
        try {
            $query = $this->db->query("SELECT * FROM utenti WHERE email = '$email' AND password = '$password'");

            // Fetch user data if the user exists
            $user = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($user) {
                // Credenziali giuste
                // Reindirizzare alla pagina corretta
                echo "<script>console.log('Il brother esiste');</script>";
                return true;
            } else {
                // Credenziali sbagliate
                // Mostrare messaggio di errore
                echo "<script>console.log('Il brother non esiste');</script>";
                return false;
            }
        } catch (PDOException $e) {
            echo "<script>console.log('Error: " . $e->getMessage() . "');</script>";
            return false;
        }
    }
}