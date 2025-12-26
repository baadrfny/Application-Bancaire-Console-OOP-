<?php

class clientRepo
{
    private $Db;


    public function __construct($Db)
    {
        $this->Db = $Db;
    }

    public function ajouteClient($nom, $email, $telephone)
    {
        try {
            $sql = "INSERT INTO clients (nom , email, telephone)
            VALUES (:nom , :email , :telephone )";
            $stmt = $this->Db->prepare($sql);
            $stmt->execute([
                ":nom" => $nom,
                ":email" => $email,
                ":telephone" => $telephone
            ]);
        } catch (Exception $e) {
            echo ($e);
        }
    }

    public function supprimeClient($email)
    {
        try {
            $sql = "DELETE FROM clients WHERE email = :email";
            $stmt = $this->Db->prepare($sql);
            $stmt->execute([
                ":email" => $email,
            ]);
        } catch (Exception $e) {
            echo ($e);
        }
    }


    public function supprimeClientSansCompte($id)
    {
        try {
            $sql = "DELETE FROM clients 
                WHERE id = :id 
                AND NOT EXISTS (SELECT 1 FROM clients WHERE id = :id AND solde <= 0)";

            $stmt = $this->Db->prepare($sql);
            $stmt->execute([":id" => $id]);

            if ($stmt->rowCount() > 0) {
                echo "this work ";
                return true;
            } else {
                echo " that error";
                return false;
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function modifieClient($id, $nom, $email, $telephone, $date_creation)
    {
        $sql = "UPDATE clients 
                SET nom = :nom,
                    email = :email,
                    telephone = :telephone,
                    date_creation = :date_creation
                WHERE id = :id
        ";
        $stmt1 = $this->Db->prepare($sql);
        $stmt1->execute([
            ":id" => $id,
            ":nom" => $nom,
            ":email" => $email,
            ":telephone" => $telephone,
            ":date_creation" => $date_creation
        ]);
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        if (!$result1) {
            return;
        }
    }


    public function afficheClient($nom)
    {
        try {
            $sql = "SELECT * FROM clients WHERE nom = :nom";
            $stmt4 = $this->Db->prepare($sql);
            $stmt4->execute([
                ":nom" => $nom
                // ":email" => $email,
                // ":telephone" => $telephone
            ]);
            return $stmt4->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo ($e);
        }
    }


    public function  afficheToutClients()
    {

        try {
            $sql = "SELECT * FROM clients ";
            $stmt = $this->Db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo ($e);
        }
    }
}
