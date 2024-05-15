<?php
require_once ("Model/UserModel.php");
class UserController
{
    public function createUser()
    {
        // registrazione
        $userModel = new UserModel();
        $messaggio = $userModel->createUser($_REQUEST['name'], $_REQUEST['surname'], $_REQUEST['email'], $_REQUEST['password']);
        // non funziona il messaggio, secondo me perché parte solo se la pagina attuale è caricata
        // però purtroppo non riesco a reidirizzare bene la pagina
        echo "<script>console.log('$messaggio');</script>";
    }
    public function checkUser()
    {
        $userModel = new UserModel();
        $messaggio = $userModel->checkUser($_POST['email'], $_POST['password']);
        echo "<script>console.log('$messaggio');</script>";
    }
    public function deleteUser()
    {
        // eliminazione
        $userModel = new UserModel();
        $userModel->eliminaUser($_POST['email'], $_POST['password']);
    }
    public function modificaUser($id)
    {
        $userModel = new UserModel();
        $userModel->modificaUser($id, $_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['password'], $_POST['isAdmin']);
        /**/
    }
    public function isAdmin()
    {
        $userModel = new UserModel();
        $valore = $userModel->isAdmin();
        return $valore;
    }
    public function sonoAdmin()
    {
        $userModel = new UserModel();
        $valore = $userModel->mostraTutti();
        return $valore;
    }



    // TEST VARI
    public function aggiungiGino()
    {
        $userModel = new UserModel();
        $userModel->createUser("Gino", "Carlo", "ginoCarlo@virgilio.it", "1234", "1");
    }
    public function cercaGino()
    {
        $userModel = new UserModel();
        $userModel->checkUser("ginoCarlo@virgilio.it", "1234");
    }
    public function eliminaGino()
    {
        $userModel = new UserModel();
        $userModel->eliminaUser("ginoCarlo@virgilio.it", "1234");
    }
}