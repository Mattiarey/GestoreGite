<?php
require_once ("Controller/UserController.php");
require_once ("Controller/GitaController.php");
require_once ("Controller/visualizzaController.php");
require_once ("Controller/metaController.php");

$request = $_SERVER['REQUEST_URI'];

$richiesta = explode("?", $request);
// Per ottimizzare mettere uno switch

// USER
//                /GestoreGite/index.php/registra
// bisogna chiamare la cartella proprio GestoreGite
if ($request == "/GestoreGite/index.php/" || $request == "/GestoreGite/index.php") {
    header("Location: ../View/UserRegistration.php");
    exit();
}
if ($request == "/GestoreGite/index.php/registra") {
    $userController = new UserController();
    $userController->createUser();
}
if ($request == "/GestoreGite/index.php/login") {
    $userController = new UserController();
    $userController->checkUser();
}

// GITA
if ($request == "/GestoreGite/index.php/aggiungiGita") {
    $gitaController = new GitaController();
    $gitaController->aggiungiGita();
}
if ($richiesta[0]  == "/GestoreGite/index.php/eliminaGita") {
    $gitaController = new GitaController();
    $gitaController->eliminaGita();
}
if ($request == "/GestoreGite/index.php/prendiGita") {
    $gitaController = new GitaController();
    $result = $gitaController->prendiGita();
    header('Content-Type: application/json');
    echo json_encode($result);
}
if ($request == "/GestoreGite/index.php/rubaGite") {
    $gitaController = new GitaController();
    $result = $gitaController->rubaGite();
    header('Content-Type: application/json');
    echo json_encode($result);
}


// Meta
if ($richiesta[0] == "/GestoreGite/index.php/aggiungiMeta"){
    $metaController = new MetaController();
    $metaController->aggiungiMeta();
}
if ($richiesta[0] == "/GestoreGite/index.php/eliminaMeta") {
    $metaController = new MetaController();
    $metaController->eliminaMeta();
}

// VISUALIZZAZIONE

if ($richiesta[0] == "/GestoreGite/index.php/aggiungiTizio") {
    if ($_COOKIE['UserConnesso'] != $_GET['mail']) {
        $vsController = new VisualizzaController();
        $vsController->aggiungiTizio($_GET['mail'], $_GET['idTour']);
    }
}

