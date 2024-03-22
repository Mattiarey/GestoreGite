# GestoreGite
 Compito su MVC di TPSIT marzo 2024

 ## Istruzioni per capire bene come funzionano tutte queste strane cartelle
  **Model** è la cartella che contiene i metodi di accesso al database, quindi i files php che contengono le varie classi con relativi metodi.

 **View** è la cartella che contiene i files che permettono all'utente di visualizzare i dati, quindi sono le cose belline
 
 **Controller** contiene i files che si occupano di ricevere i comandi dell'utente tramite il View e li modifica usando le operazioni definite nel Model e cambia quello che il file View riporta
 
 Fuori da tutte queste cartelle ci deve stare l'__index__ che deve reidirizzare alle pagine specifiche

 Per quanto riguarda il DataBase la prof non ha detto nulla di particolare, in quanto rimane salvato su XAMPP, però nel dubbio salverei anche la "costruzione del database" in un txt dentro la cartella Model
 ## Elenco di cose da fare per configurare una base
 1. Configurare il file UserModel: creare una classe per connettersi al DataBase
    ~~~
    <?php
    class UserModel {
        private $db;
        public function __construct() {
            // Connessione al database
            $this->db = new PDO('mysql:host=localhost;dbname=esempiomvc', 'root', '');
        }
        public function getUsers() {
            $query = $this->db->query('SELECT * FROM utente');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    ?>  
    ~~~