<?php
require_once ("Model/vsModel.php");
class VisualizzaController{
    public function aggiungiTizio($mail, $idTour){
        $vsModel = new VsModel($mail);
        $vsModel -> aggiungiTizio($idTour);
    }   
}