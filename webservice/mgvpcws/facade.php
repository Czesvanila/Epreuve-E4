<?php
require_once ("../classes/database.class.php");
require_once ("../classes/produit.class.php");
require_once ("../classes/produitManager.class.php");
require_once ("../classes/client.class.php");
require_once ("../classes/clientManager.class.php");
require_once ("../classes/commande.class.php");
require_once ("../classes/commandeManager.class.php");

require_once ("../classes/typeProd.class.php");
require_once ("../classes/typeProdManager.class.php");

require_once ("../classes/departement.class.php");
require_once ("../classes/departementManager.class.php");


// Retourne la liste de tous les clients
function getClients(){


    $manager = new clientManager(database::getDB());
    $tabClients = $manager->getList();
    echo json_encode($tabClients);
}

// Retourne la liste de tous les départements
function getDepartement(){
    $manager = new departementManager(database::getDB());
    $tabDepartements = $manager->getList();
    echo json_encode($tabDepartements);
}

// Retourne la liste de tous les clients par numéro de département
function getClientParDepartement($numDepart){
    $manager = new clientManager(database::getDB());
    $tabClients = $manager->getList("WHERE numDepart =". $numDepart);
    echo json_encode($tabClients);
}

// Retourne la liste de tous les produits par numéro de commande
function getProduitsParCommande($idCommande){
    $manager = new commandeManager(database::getDB());
    $tabProduits = $manager->getProduitsParCommande($idCommande);
    echo json_encode($tabProduits);
}

// Retourne le client dont l'id est passé en paramètre au format JSON.
function getClientId($id){
    $manager = new clientManager(database::getDB());
    $client = $manager->get($id);
    echo json_encode($client);
}

//retourne les clients correspondant au nom est passé en paramètre
function getClientsNom($nom){
    $manager = new clientManager(database::getDB());
    $tabClients = $manager->getList("WHERE nomCli LIKE '%".$nom."%'");
    echo json_encode($tabClients);
}

//retourne la liste de toutes les commandes pour un client donné
function getCommandesParClient($idCli){
    $manager = new commandeManager(database::getDB());
    $tabCdes = $manager->getList("WHERE idCliCde=".$idCli);
    echo json_encode($tabCdes);
}

// Ajoute un client à la base de donnée
function addClient($nom, $prenom, $rue, $cp, $ville){
    $unClient = new client($nom,$prenom,$rue,$cp,$ville);
    $manager = new clientManager(database::getDB());
    $result = $manager->save($unClient);
    echo json_encode('{"id":"'.$result.'"}');
}

// Modifie un client de la base de données
function updateClient($id,$nom, $prenom, $rue, $cp, $ville){
    $leClient = new client($nom,$prenom,$rue,$cp,$ville);
    $leClient->setId($id);
    $manager = new clientManager(database::getDB());
    $result = $manager->save($leClient);
    echo json_encode('{"id":"'.$result.'"}');
}

// Supprime un client de la base de données
function deleteClient($id){   
    $manager = new clientManager(database::getDB());
    $leClient = $manager->get($id);
    if (!is_object($leClient)) {
        echo json_encode('{"resultat":false}');
    }
    else {
        $result = $manager->delete($leClient);
        echo json_encode('{"resultat":'.$result.'}');
    }
}

// Retourne la liste de tous les type de produit
function getTypeProd(){
    $manager = new typeProdManager(database::getDB());
    $tabTypeProd = $manager->getList();
    echo json_encode($tabTypeProd);
}

// Retourne la liste de tous les type de produit par numéro de produit
function getProduitsParTypeProd($num){
    $manager = new ProduitManager(database::getDB());
    $tabProdByTypeProd = $manager->getList("WHERE numTypeProd=".$num);
    echo json_encode($tabProdByTypeProd);
}

//Retourne l'image du produit cliqué
function getImageProduit($idProd){
    $manager = new produitManager(database::getDB());
    $imageProdByIdProd=$manager->get($idProd);
    echo '{"chemin":"'.$imageProdByIdProd->getImage().'"}';
}


