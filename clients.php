<?php
/** Modele pour la gestion des clients */



/** recupération des client en fonction de leur $id
 * @args $db : connection à la base de donnée
 * @args $id : identifiant recherché
 *
 * @return : array
 *
 **/
function findClientById($db,$idClient){
    /* Donner la requete dans $sql
       Attention la restriction sur le numero du client doit avoir la forme 
       ....=:id pour que le prepare en dessous fasse son travail.
     */
    $sql="select num_client, nom_client, debit_client from client where num_client = :id";
    /* preparation de la requete */
    $stmt = $db->prepare($sql);
    /* liaison entre l'argument formel ':id' et
       l'argument actuel $idClient */
    $stmt->bindValue(':id',$idClient,PDO::PARAM_INT);
    /* lancement de la requete */
    $stmt->execute();
    /* recupération du résultat */
    $clients=[];
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $client){
	$clients[]=$client;
    }
    /* retour */
    return $clients;
}

function modifyClientDebitById($db, $idClient, $debit) {
    $sql = "update client set debit_client = :debit where num_client = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $idClient, PDO::PARAM_INT);
    $stmt->bindValue(':debit', $debit, PDO::PARAM_STR);
    $stmt->execute();
    header('Location: index.php');
}

function createClient($db, $name){
    $sql = "insert into client(nom_client) values (:name)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->execute();
    header('Location: index.php');
}
?>