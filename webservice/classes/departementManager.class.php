<?php
require_once ("database.class.php");

/**
 * Classe d'accès aux données concernant les clients.
 *
 * @author Ben
 */
class departementManager {
    
    private $db;
    
    /**
     * Instancie un objet clientManager.
     * 
     * Permet d'instanicer un objet clientManager qui nous permettra ensuite d'accéder aux données de la base spécifiée en paramètre.
     *  
     * @param database Instance de la classe database.
     */
    public function __construct($database)
    {
        //Dès le constructeur du manager on récupère la connection
        // à la base de données défini dans la classe database
        $this->db=$database;
    }    
    
    public function save(departement $depart)
    {        
        $nbRows = 0;

        // le secteur que nous essayons de sauvegarder existe-t-il dans la  base de données ?
        if ($depart->getNum()!=''){
            $query = "select count(*) as nb from `departement` where `numDepart`=?";
            $traitement = $this->db->prepare($query);
            $param1=$depart->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        
        // Si le secteur que nous essayons de sauvegarder existe dans la base de données : UPDATE
        if ($nbRows > 0)
        {
            $query = "update `departement` set `libDepart`=? where `numDepart`=?;";
            $traitement = $this->db->prepare($query);
            $param1=$depart->getlib();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
                       
        }
        // sinon : INSERT
        else
        {
            $query = "insert into `departement` (`libDepart`) values (?);";
            $traitement = $this->db->prepare($query);
            $param1=$depart->getlib();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
        }
        
        if ($depart->getNum() == "")
        {
            $depart->setNum($this->db->lastInsertId());
        }
        return $depart->getNum();
    }

    /**
     * Supprime le département de la base.
     * 
     * Supprime de la base le client (table "client"), les commandes (table "commande") passées par celui-ci et les lignes de commandes associées (table "comporter").
     * 
     * @param produit Objet client devant être supprimé.
     * @return boolean Retourne TRUE si la suppression est un succès, FALSE sinon.
     */    
    public function delete(department $depart)
    {
        $nbRows = 0;

        // le client que nous essayons de supprimer existe-t-il dans la  base de données ?
        if ($depart->getNum()!=''){                    
            $query = "select count(*) as nb from `departement` where `numDepart`=?";
            $traitement = $this->db->prepare($query);
            $param1 = $depart->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }

        // SI le client que nous essayons de supprimer existe dans bd
        // ALORS
        //      DELETE FROM client, departement
        //          et retourne TRUE
        if ($nbRows > 0)
        {   
            
            // DELETE FROM commande
            $query = "DELETE FROM client WHERE numDepart=?;";
            $traitement = $this->db->prepare($query);
            $param1 = $depart->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            
            // DELETE FROM client
            $query = "DELETE FROM departement WHERE numDepart=?;";
            $traitement = $this->db->prepare($query);
            $param1 = $depart->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            
            return true;
        }
        // SINON
        //      retourne FALSE
        else {
            return false;
        }
    }

    /**
     * Sélectionne un(des) client(s) dans la base.
     * 
     * Méthode générique de SELECT qui renvoie un tableau de client correspondant aux critères de sélection spécifiés.
     * Si aucun paramètre n'est précisé, la valeur par défaut du paramètre 'WHERE 1' permet d'obtenir tous les clients.
     * 
     * @param string Chaîne de caractère devant être une restriction SQL valide.
     * @return array Renvoie un tableau d'objet(s) client.
     */
    public function getList($restriction='WHERE 1')
    {
        $query = "select * from `departement` ".$restriction.";";
        $departList = Array();

        //execution de la requete
        try
        {
            $result = $this->db->Query($query);
        }
        catch(PDOException $e)
        {
            die ("Erreur : ".$e->getMessage());
        }

        //Parcours du jeu d'enregistrement
        while ($row = $result->fetch())
        {
            //appel du constructeur paramétré
            $depart = new departement($row['numDepart'],$row['libDepart']);
            //positionnement de l'id
            $depart->setNum($row['numDepart']);
            //ajout de l'objet à la fin du tableau
            $departList[] = $depart;
        }
        //retourne le tableau d'objets 'client'
        return $departList;   
    }
    
    /**
     * Sélectionne un client dans la base.
     * 
     * Méthode de SELECT qui renvoie le client dont l'id est spécifié en paramètre.
     * 
     **/ 
    public function get($numDepart)
    {
        $query = "select * from `depart` WHERE `numDepart`=?;";

        //Connection et execution de la requete
        try
        {
            $traitement = $this->db->prepare($query);
            $traitement->bindparam(1,$numDepart);
            $traitement->execute();
        }
        catch(PDOException $e)
        {
            die ("Erreur : ".$e->getMessage());
        }

        //On récupère la première et seule ligne du jeu d'enregistrement	
        if($row = $traitement->fetch()) {
            //On instancie un objet 'client' avec les valeurs récupérées
            //appel du constructeur paramétré
            $depart = new departement($row['libDepart']);
            //positionnement de l'id
            $depart->setNum($row['numDepart']);

            //retourne l'objet 'client' correpsondant
            return $depart;
        }
        else {
            return false;
        }
    }

    
}