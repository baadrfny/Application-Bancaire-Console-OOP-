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

    public function modifieClient($nom, $email)
    {
        $sql = "SELECT * FROM clients WHERE email = :email";
        $stmt1 = $this->Db->prepare($sql);
        $stmt1->execute([
            ":email" => $email
        ]);
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        if (!$result1) {
            return;
        }

        $id = $result1[0]["id"];
        try {
            $sql = "UPDATE clients SET nom = :nom , email = :email WHERE id = :id";
            $stmt2 = $this->Db->prepare($sql);
            $stmt2->execute([
                ":nom" => $nom,
                ":email" => $email,
                ":id" => $id
            ]);

            $sql = "SELECT * FROM clients WHERE id = :id";
            $stmt3 = $this->Db->prepare($sql);
            $stmt3->execute([
                ":id" => $id
            ]);
            print_r($stmt3->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print_r($e);
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
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo ($e);
        }
    }
}
