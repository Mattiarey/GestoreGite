<?php
require_once("Model/UserModel.php");
class UserController {
    public function index() {
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        include './View/UserView.php';
    }
    public function aggiungiGino(){
        $userModel = new UserModel();
        $userModel->createUser("Gino", "Carlo", "ginoCarlo@virgilio.it", "1234", "1");
    }
    public function cercaGino(){
        $userModel = new UserModel();
        $userModel->checkUser("ginoCarlo@virgilio.it", "1234");
    }
}