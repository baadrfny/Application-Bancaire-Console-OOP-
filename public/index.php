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

$newClient = $clientRepo->modifieClient("2","Ali","ali@gmail.com","051278031",$date_creation);




// $compteRepo = new compteRepo($pdo);
// $compte1 = $compteRepo->ajouteCompte("2","courant","45000",$date_creation);

// echo "ajoute de compte success ";
echo " <br>" . "---------------------------------------------------------------------------------" . " <br>" ;

$compteRepo = new compteRepo($pdo);
// $compte1 = $compteRepo->supprimeCompte("2");
echo "Suppimer de comlpte success ";

echo " <br>" . "---------------------------------------------------------------------------------" . " <br>" ;
echo " <br>" . "--------------------------    AFFiCHAGE D'UN COMPTE   ---------------------------" . " <br>" ;

$comptes = $compteRepo->afficheCompte("2");

foreach($comptes as $client){
    echo "Client ID :" . $client['client_id'] . "<br>";
    echo "Type de compte :" .$client['TYPE'] . "<br>";
    echo "Solde de compte :" .$client['solde']. "$" . "<br>" ;
}
echo "affichage de compte success";
echo " <br>" . "---------------------------------------------------------------------------------" . " <br>" ;
echo " <br>" . "--------------------------    AFFiCHAGE DES COMPTES   ---------------------------" . " <br>" ;


$toutComptes = $compteRepo->afficheToutCompte();
foreach ($toutComptes as $uneCompte) {
    echo "Client ID :" . $uneCompte['client_id'] . "<br>";
    echo "Type de compte :" .$uneCompte['TYPE']. "<br>";
    echo "Solde de compte :" .$uneCompte['solde']. "<br>". "<br>";
}




// $courant = new compteCourant("1001",12500,"8010");
// $courant->retirer(1200);
// $epargne = new compteEpargne("1002",1200,"8020");
// echo "Votre Solde bancaire :  " . $courant;


?>