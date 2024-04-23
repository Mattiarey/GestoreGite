<?php
require_once("Controller/UserController.php");
require_once("Controller/GitaController.php");

$request = $_SERVER['REQUEST_URI'];
// forse sarebbe meglio fare uno switch

// USER
if($request == "/GestoreGite/index.php/registra")
{
    $userController = new UserController();
    $userController -> createUser();
}
if($request == "/GestoreGite/index.php/login"){
    $userController = new UserController();
    $userController -> checkUser();
}

// GITA
if($request == "/GestoreGite/index.php/aggiungiGita"){
    $gitaController = new GitaController();
    $gitaController -> aggiungiGita();
}
if($request == "/GestoreGite/index.php/eliminaGita"){
    $gitaController = new GitaController();
    $gitaController -> eliminaGita();
}
