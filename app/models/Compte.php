<?php 

abstract class Compte{
    protected $numero;
    protected $solde;
    protected $client_id;

    public function __construct($numero,$solde,$client_id)
    {
        $this->numero = $numero;
        $this->solde = $solde;
        $this->client_id = $client_id;
    }

    abstract public function deposer($montant);
    abstract public function retirer($montant);

    public function getSolde(){
        return $this->solde;
    }
}

?>