<?php
class Tour
{
    public $id;
    public $nome;
    public $descrizione;
    public $durata;
    public $costo;
    public $fkMeta;
    public $maxPart;
    public $partAtt;
    public function __construct($id, $nome, $descrizione, $durata, $costo, $fkMeta, $maxPart, $partAtt){
        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->durata = $durata;
        $this->costo = $costo;
        $this->fkMeta = $fkMeta;
        $this->maxPart = $maxPart;
        $this->partAtt = $partAtt;
    }
}
class Gitameta
{
    public $id;
    public $nome;
    public $descrizione;
    public $data;
    public $costo;
    public $tours;
    public function __construct($id, $nome, $descrizione, $data, $costo, $tours){
        // speriamo vada bene l'array fatto così
        // tours deve essere un array fatto dagli oggetti della classe Tour
        // siccome non è tipizzato spero non ci siano problemi
        $this->tours = $tours;

        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->data = $data;
        $this->costo = $costo;
    }
}
