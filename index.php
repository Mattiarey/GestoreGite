<?php
require_once("Controller/UserController.php");

$request = $_SERVER['REQUEST_URI'];
if($request == "/GestoreGite/")
{
    $userController = new UserController();
    #$userController -> aggiungiGino();
    #$userController -> cercaGino();
    #$userController -> eliminaGino();
    $userController -> index();
}