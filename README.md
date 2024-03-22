# GestoreGite
 Compito su MVC di TPSIT Marzo 2024

 ## Istruzioni per capire bene come funzionano tutte queste strane cartelle
  **Model** è la cartella che contiene i metodi di accesso al database, quindi i files php che contengono le varie classi con relativi metodi.

 **View** è la cartella che contiene i files che permettono all'utente di visualizzare i dati, quindi sono le cose belline
 
 **Controller** contiene i files che si occupano di ricevere i comandi dell'utente tramite il View e li modifica usando le operazioni definite nel Model e cambia quello che il file View riporta
 
 Fuori da tutte queste cartelle ci deve stare l'__index__ che deve reidirizzare alle pagine specifiche

 Per quanto riguarda il DataBase la prof non ha detto nulla di particolare, in quanto rimane salvato su XAMPP, però nel dubbio salverei anche la "costruzione del database" in un txt dentro la cartella Model
 ## Elenco di cose da fare per configurare una base
 1. Configurare il file UserModel: creare una classe per connettersi al DataBase
    ~~~php
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
    ~~~
 2. Configurare il file UserController: creare una classe che utilizzi i metodi della classe UserModel e che li metta in una variabile utilizzabile anche dal file UserView
    ~~~php
    require_once("Model/UserModel.php");
    class UserController {
        public function index() {
            $userModel = new UserModel();
            $users = $userModel->getUsers();
            include 'View/user_view.php';
        }
    }
    ~~~
3. Configurare in fine il file UserView: creare il file html (php) per visualizzare le variabili salvate dallo UserController
    ~~~html
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista utenti</title>
    </head>
    <body>
        <h1>Lista Utenti</h1>
        <ul>
            <?php foreach ($users as $user): ?>
                <li><?= $user['nome'] ?></li>
            <?php endforeach; ?>
        </ul>
    </body>
    </html>
    ~~~