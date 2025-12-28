<?php
require_once "../app/config/conn.php";

class Transaction {
    private $compte_id;
    private $TYPE;
    private $montant;
    private $frais;
    private $DATE;
    private $pdo;

    public function __construct($compte_id, $TYPE, $montant, $frais = 0) {
        $this->compte_id = $compte_id;
        $this->TYPE = $TYPE;
        $this->montant = $montant;
        $this->frais = $frais;
        $this->DATE = DATE("Y-m-d H:i:s");
        $this->pdo = Db::getInstance()->getConnection();
    }

    public function save() {
        try {
            
            $sql = "INSERT INTO transactions (compte_id, TYPE, montant, frais, DATE) 
                    VALUES (:compte_id, :TYPE, :montant, :frais, :DATE)";
            
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':compte_id' => $this->compte_id,
                ':TYPE'      => $this->TYPE,
                ':montant'   => $this->montant,
                ':frais'     => $this->frais,
                ':DATE'      => $this->DATE
            ]);
        } catch (Exception $e) {
            error_log("Error saving transaction: " . $e->getMessage());
            return false;
        }
    }

    public static function getHistorique($compte_id) {
        try {
            $db = Db::getInstance()->getConnection();
            
            $sql = "SELECT * FROM transactions WHERE compte_id = :id ORDER BY DATE DESC";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $compte_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching history: " . $e->getMessage());
            return [];
        }
    }
}