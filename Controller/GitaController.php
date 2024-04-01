<?php
require_once ("Model/GitaModel.php");

class GitaController
{
    public function aggiungiGita(){
        $gitaModel = new GitaModel();
        //                                                                     anno/mese/giorno
        $gitaModel->creaGita("Pizzo Calabro", "Un bellissimo posto in Calabria", "03/02/24", 25, 7);
    }
}
