<?php
require_once("Model/UserModel.php");
class UserController {
    public function index() {
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        include 'View/user_view.php';
    }
}