<?php
require_once "Compte.php";
require_once "../app/config/conn.php";

class compteEpargne extends Compte
{
    private $pdo;

    public function __construct($id, $solde, $client_id)
    {
        parent::__construct($id, $solde, $client_id);
        $this->pdo = Db::getInstance()->getConnection();
    }

    public function deposer($montant)
    {
        $this->solde += $montant;
        $this->updateDatabase();
        $t = new Transaction($this->id, 'Depot', $montant);
        $t->save();
    }

    public function retirer($montant)
    {
        if ($this->solde >= $montant) {
            $this->solde -= $montant;
            $t = new Transaction($this->id, 'Depot', $montant);
            $t->save();
            $this->updateDatabase();
        } else {
            echo "Vous ne pouvez pas retirer de fonds : Solde insuffisant!";
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
