<?php
require_once("Model/MetaModel.php");
class MetaController{
    public function aggiungiMeta(){
        $gitaModel = new MetaModel();
        $gitaModel->creaMeta($_POST['nome'], $_POST['descrizione'], $_POST['durata'], $_POST['costo'], $_POST['maxPart'], $_POST['fkMeta']);
    }
    public function eliminaMeta(){
        $gitaModel = new MetaModel();
        $gitaModel->eliminaMeta($_GET['id']);
    }
    public function mostraMetina(){
        $gitaModel = new MetaModel();
        $value = $gitaModel->mostraMetina($_GET['id']);
        return $value;
    }
    public function modificaMeta()
    {
        $gitaModel = new MetaModel();
        $gitaModel->modificaMeta($_GET['id'], $_POST['nome'], $_POST['descrizione'], $_POST['durata'], $_POST['costo'], $_POST['maxPart']);
    }
}   