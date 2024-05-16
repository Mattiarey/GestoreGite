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
        $valore = "";
        try {
            // guardare se non è già stato creato il record (almeno la mail)
            $query = $this->db->query("SELECT * FROM utenti WHERE email = '$email'");
            $risultato = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($risultato) == 0) {
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

                $valore = "Record creato";
                setcookie('UserConnesso', $email, time() + (86400 * 30), "/");
                // serve toglierlo quando si fa il logout? oppure basta sovrascriverlo

                header("Location: ../View/homepage.html", true);
                exit();
            } else {
                $valore = "Utente già esistente";
                header("Location: ../View/UserRegistration.php", true);
                exit();
            }

        } catch (PDOException $e) {
            $valore = "Error: " . $e->getMessage();
        }
        return $valore;
    }
    public function eliminaUser($id)
    {
        $query = "DELETE FROM utenti WHERE id = $id";
        $statement = $this->db->prepare($query);
        $statement->execute();
        header("Location: ../View/gestisciUtenti.html", true);
        exit();
    }
    public function checkUser($email, $password)
    {
        $valore = "";
        try {
            $query = $this->db->query("SELECT * FROM utenti WHERE email = '$email' AND password = '$password'");


            $user = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($user) {
                // Credenziali giuste
                // Reindirizzare alla pagina corretta
                $valore = 'Il brother esiste';
                setcookie('UserConnesso', $email, time() + (86400 * 30), "/");
                header("Location: ../View/homepage.html", true);
                return $valore;
            } else {
                // Credenziali sbagliate
                // Mostrare messaggio di errore
                $valore = 'Il brother non esiste';
                header("Location: ../View/UserLogin.php", true);
                return $valore;
            }
        } catch (PDOException $e) {
            $valore = "Error: " . $e->getMessage();
            header("Location: ../View/UserLogin.php", true);
            return $valore;
        }
    }
    public function isAdmin()
    {
        $mailBro = $_COOKIE["UserConnesso"];
        $query = $this->db->query("SELECT isAdmin FROM utenti WHERE email = '$mailBro'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function mostraTutti()
    {
        $mailBro = $_COOKIE["UserConnesso"];
        // non puoi modificare il tuo stesso profilo, in questo modo ci sarà sempre almeno un admin
        $query = $this->db->query("SELECT * FROM utenti WHERE NOT email = '$mailBro'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function modificaUser($id, $new_nome, $new_cognome, $new_email, $new_password, $new_isAdmin)
    {

        $numerino = 0;
        if ($new_isAdmin == "on")
            $numerino = 1;
        else
            $numerino = 0;

        // Query di aggiornamento
        $query = "UPDATE utenti SET nome = '$new_nome', cognome = '$new_cognome', email = '$new_email', password = '$new_password', isAdmin = '$numerino' WHERE id = $id";
        $statement = $this->db->prepare($query);
        $statement->execute();
        header("Location: ../View/gestisciUtenti.html", true);
        exit();
    }
    
}