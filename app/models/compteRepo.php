<?php

class compteRepo
{
    private $Db;

    public function __construct($Db)
    {
        $this->Db = $Db;
    }

    public function ajouteCompte($client_id, $TYPE, $solde, $date_creation)
    {
        try {
            $sql = "INSERT INTO comptes (client_id,`TYPE`,solde,date_creation)
            VALUES (:client_id, :TYPE, :solde , :date_creation)";

            $stmt = $this->Db->prepare($sql);
            $stmt->execute([
                ":client_id" => $client_id,
                ":TYPE" => $TYPE,
                ":solde" => $solde,
                ":date_creation" => $date_creation
            ]);
        } catch (Exception $e) {
            echo ($e);
        }
    }

    public function supprimeCompte($client_id)
    {
        try {
            $sql = "DELETE FROM comptes WHERE client_id = :client_id";
            $stmt = $this->Db->prepare($sql);
            $stmt->execute([
                ":client_id" => $client_id
            ]);
        } catch (Exception $e) {
            echo ($e);
        }
    }


    public function supprimeCompteSansSolde($client_id)
    {
        try {
            $sql = "DELETE FROM comptes 
                    WHERE client_id = :client_id 
                    AND solde <= 0";

            $stmt = $this->Db->prepare($sql);
            $stmt->execute([":client_id" => $client_id]);

            return true;
             
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function afficheCompte($client_id)
    {
        try {
            $sql = "SELECT * FROM comptes WHERE client_id = :client_id";
            $stmt = $this->Db->prepare($sql);
            $stmt->execute([
                ":client_id" => $client_id
            ]);
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo ($e);
        }
    }
    public function afficheToutCompte()
    {
        try {
            $sql = "SELECT * FROM comptes ";
            $stmt = $this->Db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo ($e);
        }
    }


    public function effectuerDepot($id, $montant)
    {
        try {
            $sql = "SELECT * FROM comptes WHERE id = :id";
            $stmt = $this->Db->prepare($sql);
            $stmt->execute([":id" => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $compte = new CompteCourant($row['id'], $row['solde'], $row['client_id']);

                $compte->deposer($montant);

                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }


    public function effectuerRetrait($id, $montant)
    {
        try {
            
            $sql = "SELECT * FROM comptes WHERE id = :id";
            $stmt = $this->Db->prepare($sql);
            $stmt->execute([":id" => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                
                $compte = new CompteCourant($row['id'], $row['solde'], $row['client_id']);

                
                $compte->retirer($montant);

                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }





    public function effectuerDepotE($id, $montant) {
    $stmt = $this->Db->prepare("SELECT * FROM comptes WHERE id = :id");
    $stmt->execute([":id" => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {


        if ($row['TYPE'] == 'Epargne') {
            $compte = new compteEpargne($row['id'], $row['solde'], $row['client_id']);
        } else {
            $compte = new CompteCourant($row['id'], $row['solde'], $row['client_id']);
        }

        $compte->deposer($montant);
        return true;
    }
    return false;
}
}