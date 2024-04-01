<?php
require_once("Controller/UserController.php");
require_once("Controller/GitaController.php");

$request = $_SERVER['REQUEST_URI'];
if($request == "/GestoreGite/")
{
    $userController = new UserController();
    #$userController -> aggiungiGino();

    $gitaController = new GitaController();
    $gitaController->aggiungiGita();
    #$userController -> cercaGino();
    #$userController -> eliminaGino();
    $userController -> index();
}