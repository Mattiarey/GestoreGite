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
    public function eliminaUser($id)
    {
        $userModel = new UserModel();
        $userModel->eliminaUser($id);
    }


}