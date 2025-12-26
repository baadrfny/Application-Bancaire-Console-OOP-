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
}
