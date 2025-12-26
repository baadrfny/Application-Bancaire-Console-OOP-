<?php
require_once "Compte.php";
require_once "../app/config/conn.php";



class CompteCourant extends Compte
{
    private $fraisDepot;
    private $decouvert;

    public function __construct($numero, $solde, $client_id, $fraisDepot = 1, $decouvert = -500)
    {
        parent::__construct($numero, $solde, $client_id);
        $this->fraisDepot = $fraisDepot;
        $this->decouvert = $decouvert;
    }

    public function deposer($montant)
    {
        $this->solde += $montant;
        $this->solde -= $this->fraisDepot;
    }

    public function retirer($montant)
    {
        if (($this->solde - $montant) >= $this->decouvert) {
            $this->solde -= $montant;
        } else {
            echo "Vous ne pouvez pas retirer de fonds!";
        }
    }
}



