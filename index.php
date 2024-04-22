<?php
require_once("Controller/UserController.php");
require_once("Controller/GitaController.php");

$request = $_SERVER['REQUEST_URI'];
if($request == "/GestoreGite/index.php/registra")
{
    $userController = new UserController();
    $userController -> createUser();
}
if($request == "/GestoreGite/index.php/login"){
    $userController = new UserController();
    $userController -> checkUser();
}