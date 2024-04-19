<?php
require_once("Model/UserModel.php");
class UserController {
    
    /*public function index() {
        $request = $_SERVER['REQUEST_URI'];
        echo($_SERVER['REQUEST_URI']);
        switch($request){
            case "../Controller/UserController.php/createUser":
                $this->createUser();
                break;
        }
    }*/
    public function createUser(){
        // registrazione
        $userModel = new UserModel();
        $users = $userModel->createUser($_REQUEST['name'], $_REQUEST['surname'], $_REQUEST['email'], $_REQUEST['password']);
    }
    public function checkUser(){
        $userModel = new UserModel();
        $users = $userModel->checkUser($_POST['email'], $_POST['password']);
    }
    public function deleteUser(){
        // eliminazione
        $userModel = new UserModel();
        $users = $userModel->eliminaUser($_POST['email'], $_POST['password']);
    }
    public function updateUser(){
        // modifica
    }



    // TEST VARI
    public function aggiungiGino(){
        $userModel = new UserModel();
        $userModel->createUser("Gino", "Carlo", "ginoCarlo@virgilio.it", "1234", "1");
    }
    public function cercaGino(){
        $userModel = new UserModel();
        $userModel->checkUser("ginoCarlo@virgilio.it", "1234");
    }
    public function eliminaGino(){
        $userModel = new UserModel();
        $userModel->eliminaUser("ginoCarlo@virgilio.it", "1234");
    }
}