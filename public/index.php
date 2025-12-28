<?php

require_once '../app/config/conn.php';
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




$compteRepo = new compteRepo($pdo);
// // $compte1 = $compteRepo->ajouteCompte(92,'courant',13000,$date_creation);


// $CompteCourant = new CompteCourant(5000,2);
// $accCourant = $CompteCourant->deposer(502,5);



echo "ajoute de compte success ";
echo " <br>" . "---------------------------------------------------------------------------------" . " <br>" ;

$clientRepo = new clientRepo($pdo);
$compte1 = $clientRepo->supprimeClientSansCompte("12");
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

echo " <br>" . "--------------------------    Supprimer compte avec solde = 0   ---------------------------" . " <br>" ;
$compteRepo = new compteRepo($pdo);
$deletedAcc = $compteRepo->supprimeCompteSansSolde("10");

echo " <br>" . "---------------------------------------------------------------------------------------------------------------------------" . " <br>" ;



// $compteRepo = new compteRepo($pdo);

// if ($compteRepo->effectuerDepot(19,800)) {
//     echo "Deposer avec success";
// } else {
//     echo "Error in Deposer ! , (Incorrect id)";
// }


$compteRepo = new compteRepo($pdo);

if ($compteRepo->effectuerDepotE(20,3000)) {
    echo "Deposer avec success";
} else {
    echo "Error in Deposer ! , (Incorrect id)";
}




$compteRepo = new compteRepo($pdo);

if ($compteRepo->effectuerRetrait(20, 799)) {
    echo "Withdrawal successful!";
} else {
    echo "Withdrawal failed (Check ID or Balance limit).";
}

$id_compte = 20;
$historique = Transaction::getHistorique($id_compte); 

echo "<h2>Historique du compte #$id_compte</h2>";

if (!empty($historique)) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Date</th><th>Type</th><th>Montant</th><th>Frais</th></tr>";
    
    foreach ($historique as $action) {
        echo "<tr>";
        echo "<td>" . $action['DATE'] . "</td>"; 
        echo "<td>" . $action['TYPE'] . "</td>";
        echo "<td>" . $action['montant'] . " DH</td>";
        echo "<td>" . $action['frais'] . " DH</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucune transaction trouvée.";
}

?>