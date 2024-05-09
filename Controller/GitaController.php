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
        $gitaModel->eliminaGita($_POST['nome'], $_POST['data']);
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

    // Per capire
    private function ProvaggiungiGita()
    {
        $gitaModel = new GitaModel();
        //                                                                     anno/mese/giorno
        $gitaModel->creaGita("Pizzo Calabro", "Un bellissimo posto in Calabria", "03/02/24", 25);
    }
}
