<?php
class Tour
{
    private $id;
    private $nome;
    private $descrizione;
    private $durata;
    private $costo;
    public function __construct($id, $nome, $descrizione, $durata, $costo){
        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->durata = $durata;
        $this->costo = $costo;
    }
}
class Gitameta
{
    private $id;
    private $nome;
    private $descrizione;
    private $data;
    private $costo;
    private $maxPart;
    private $tours;
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
