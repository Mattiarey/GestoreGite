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
if ($request == "/GestoreGite/index.php/isAdmin") {
    $userController = new UserController();
    $result = $userController->isAdmin();
    header('Content-Type: application/json');
    echo json_encode($result);
}
if ($request == "/GestoreGite/index.php/mostraTutto") {
    $userController = new UserController();
    $result = $userController->sonoAdmin();
    header('Content-Type: application/json');
    echo json_encode($result);
}
if ($richiesta[0] == "/GestoreGite/index.php/modifica") {
    $userController = new UserController();
    $userController->modificaUser($_GET['id']);
}
if ($richiesta[0] == "/GestoreGite/index.php/elimina") {
    $userController = new UserController();
    $userController->eliminaUser($_GET['id']);
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
if ($request == "/GestoreGite/index.php/sonoAdmin") {
    $gitaController = new GitaController();
    $result = $gitaController->sonoAmministrazione();
    header('Content-Type: application/json');
    echo json_encode($result);
}
if ($richiesta[0]  == "/GestoreGite/index.php/mostraGitina") {
    $gitaController = new GitaController();
    $value = $gitaController->mostraGitina();
    header('Content-Type: application/json');
    echo $value;
}
if ($richiesta[0]  == "/GestoreGite/index.php/modificaGita") {
    $gitaController = new GitaController();
    $gitaController->modificaGita();
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
if ($richiesta[0]  == "/GestoreGite/index.php/mostraMetina") {
    $gitaController = new MetaController();
    $value = $gitaController->mostraMetina();
    header('Content-Type: application/json');
    echo $value;
}
if ($richiesta[0]  == "/GestoreGite/index.php/modificaMeta") {
    $gitaController = new MetaController();
    $gitaController->modificaMeta();
}

// VISUALIZZAZIONE

if ($richiesta[0] == "/GestoreGite/index.php/aggiungiTizio") {
    if ($_COOKIE['UserConnesso'] != $_GET['mail']) {
        $vsController = new VisualizzaController();
        $vsController->aggiungiTizio($_GET['mail'], $_GET['idTour']);
    }
}

