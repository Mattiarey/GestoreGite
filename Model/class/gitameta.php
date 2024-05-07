<?php
class Tour
{
    public $id;
    public $nome;
    public $descrizione;
    public $durata;
    public $costo;
    public $fkMeta;
    public function __construct($id, $nome, $descrizione, $durata, $costo, $fkMeta){
        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->durata = $durata;
        $this->costo = $costo;
        $this->fkMeta = $fkMeta;
    }
}
class Gitameta
{
    public $id;
    public $nome;
    public $descrizione;
    public $data;
    public $costo;
    public $maxPart;
    public $tours;
    public function __construct($id, $nome, $descrizione, $data, $costo, $maxPart, $tours){
        // speriamo vada bene l'array fatto così
        // tours deve essere un array fatto dagli oggetti della classe Tour
        // siccome non è tipizzato spero non ci siano problemi
        $this->tours = $tours;

        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->data = $data;
        $this->costo = $costo;
        $this->maxPart = $maxPart;
    }
}
