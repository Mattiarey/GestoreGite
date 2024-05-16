<?php
require_once ("Model/GitaModel.php");

class GitaController
{
    public function aggiungiGita()
    {
        $gitaModel = new GitaModel();
        $gitaModel->creaGita($_POST['nome'], $_POST['descrizione'], $_POST['data'], $_POST['costo']);
    }
    public function eliminaGita()
    {
        $gitaModel = new GitaModel();
        $gitaModel->eliminaGita($_GET['id']);
    }
    public function prendiGita(){
        $gitaModel = new GitaModel();
        $result = $gitaModel->prendiGita();
        return $result;
    }
    public function rubaGite(){
        $gitaModel = new GitaModel();
        $result = $gitaModel->rubaGite();
        return $result;
    }
    public function sonoAmministrazione(){
        $gitaModel = new GitaModel();
        $result = $gitaModel->sonoAdmin();
        return $result;
    }
    public function mostraGitina(){
        $gitaModel = new GitaModel();
        $value = $gitaModel->mostraGitina($_GET['id']);
        return $value;
    }
    public function modificaGita()
    {
        $gitaModel = new GitaModel();
        $gitaModel->modificaGita($_GET['id'], $_POST['nome'], $_POST['descrizione'], $_POST['data'], $_POST['costo']);
    }
}
