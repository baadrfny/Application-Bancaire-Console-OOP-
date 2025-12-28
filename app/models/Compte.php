<?php 

abstract class Compte{
    protected $id;
    protected $solde;
    protected $client_id;

    public function __construct($id,$solde,$client_id)
    {
        
        $this->solde = $solde;
        $this->id = $id;
        $this->client_id = $client_id;
    }

    abstract public function deposer($montant);
    abstract public function retirer($montant);

    public function getSolde(){
        return $this->solde;
    }
}

?>