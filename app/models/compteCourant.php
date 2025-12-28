<?php
require_once "Compte.php";
require_once "../app/config/conn.php";
require_once "Transactions.php";

class CompteCourant extends Compte
{
    private $fraisDepot;
    private $decouvert;
    private $pdo;


    public function __construct($id, $solde, $client_id, $fraisDepot = 1, $decouvert = -500)
    {


        parent::__construct($id, $solde, $client_id);

        $this->id = $id;
        $this->fraisDepot = $fraisDepot;
        $this->decouvert = $decouvert;
        $this->pdo = Db::getInstance()->getConnection();
    }

    public function deposer($montant)
    {
        $this->solde += ($montant - $this->fraisDepot);
        $this->updateDatabase();

        $t = new Transaction($this->id, 'Depot', $montant, $this->fraisDepot);
        $t->save();
    }

    public function retirer($montant)
    {
        if (($this->solde - $montant) >= $this->decouvert) {
            $this->solde -= $montant;
            $this->updateDatabase();
            $t = new Transaction($this->id, 'Depot', $montant);
            $t->save();
        } else {
            echo "Vous ne pouvez pas retirer de fonds!";
        }
    }

    private function updateDatabase()
    {
        $stmt = $this->pdo->prepare("UPDATE comptes SET solde = :solde WHERE id = :id");
        $stmt->execute([
            ':solde' => $this->solde,
            ':id' => $this->id
        ]);
    }
}
