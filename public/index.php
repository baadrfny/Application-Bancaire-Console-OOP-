<?php


// require_once '../app/config/conn.php';
require_once '../app/models/Compte.php';
require_once '../app/models/compteCourant.php';
require_once '../app/models/clientRepo.php';
require_once '../app/models/compteRepo.php';

// $db = new Db(); 
// echo "<pre>";
// print_r($db);
// echo "</pre>";


// $nom = "Badr";

// $clientRepo = new clientRepo($pdo);
// $clients = $clientRepo->afficheClient($nom);

// foreach($clients as $client) {
//     echo $client['nom'] . "<br>";
//     echo $client['email'] . "<br>";
//     echo $client['telephone'] . "<br>";
// }

$clientRepo = new clientRepo($pdo);
$toutClients = $clientRepo->afficheToutClients();
foreach ($toutClients as $client) {
    echo "Id : " . $client['id'] . "<br>";
    echo "Nom : " . $client['nom']. "<br>";
    echo "Email : " . $client['email']. "<br>";
    echo "Telephone : " . $client['telephone']. "<br>". "<br>";
}

echo "-------------------------------------------------" . "<br>";




$date_creation = date("Y-m-d H:i:s");
// $compteRepo = new compteRepo($pdo);
// $compte1 = $compteRepo->ajouteCompte("2","courant","45000",$date_creation);

// echo "ajoute de compte success ";
echo " <br>" . "---------------------------------------------------------------------------------" . " <br>" ;

$compteRepo = new compteRepo($pdo);
$compte1 = $compteRepo->supprimeCompte("2");
echo "Suppimer de comlpte success ";

echo " <br>" . "---------------------------------------------------------------------------------" . " <br>" ;


// $courant = new compteCourant("1001",12500,"8010");
// $courant->retirer(1200);
// $epargne = new compteEpargne("1002",1200,"8020");
// echo "Votre Solde bancaire :  " . $courant;


?>