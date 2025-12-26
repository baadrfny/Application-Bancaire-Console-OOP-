<?php
require_once "../models/Compte.php";

class compteEpargne extends Compte{
    public function deposer($montant){
        $this->solde += $montant;
    }
    public function retirer($montant){
        if (!$this->solde >= $montant) {
            $this->solde -= $montant;
        }
        else{
            echo "Vous ne pouvez pas retirer de fonds";
        }
    }
}

?>