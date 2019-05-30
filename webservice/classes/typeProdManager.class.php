<?php
require_once ("database.class.php");

/**
 * Classe d'accès aux données concernant les types produits.
 * 
 * <br>TESTS :  OK
 * <br>DOC :    OK
 *
 * @author Nina
 */
class typeProdManager {
    
    private $db;
    
    /**
     * Instancie un objet produitManager.
     * 
     * Permet d'instanicer un objet produitManager qui nous permettra ensuite d'accéder aux données de la base spécifiée en paramètre.
     *  
     * @param database Instance de la classe database.
     */
    public function __construct($database)
    {
        //Dès le constructeur du manager on récupère la connection
        // à la base de données défini dans la classe database
        $this->db=$database;
    }    
    
    /**
     * Enregistre ou Modifie le produit dans la base.
     * 
     * Pour enregistrer le produit passé en paramètre en base de données :
     *      <br>UPDATE si le produit est déjà existant;
     *      <br>INSERT sinon (si id non trouvé ou non spécifié).
     * 
     * @param typeProd TypeProd à enregister ou mettre à jour.
     * 
     * @return int Retourne le num du type produit ajouté ou mis à jour.
     */
    public function save(type $type)
    {        
        $nbRows = 0;

        // le secteur que nous essayons de sauvegarder existe-t-il dans la  base de données ?
        if ($type->getNum()!=''){
            $query = "select count(*) as nb from `typeProd` where `numTypeProd`=?";
            $traitement = $this->db->prepare($query);
            $param1=$type->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        
        // Si le secteur que nous essayons de sauvegarder existe dans la base de données : UPDATE
        if ($nbRows > 0)
        {
            $query = "update `typeProd` set `libType`=? where `numTypeProd`=?;";
            $traitement = $this->db->prepare($query);
            $param1=$type->getLib();
            $traitement->bindparam(1,$param1);
            $param2=$type->getNum();
            $traitement->bindparam(2,$param2);
            $traitement->execute();
        }
        // sinon : INSERT
        else
        {
            $query = "insert into `TypeProd` (`numTypeProd`, `libType`) values (?,?);";
            $traitement = $this->db->prepare($query);
            $param1=$type->getNum();
            $traitement->bindparam(1,$param1);
            $param2=$type->getLib();
            $traitement->bindparam(2,$param2);
            $traitement->execute();               
        }
        
        return $type->getNum();
    }

    /**
     * Supprime le type de produit de la base.
     * 
     * Supprime le type de produit de la base et les lignes de commandes associées de la table "comporter".
     * 
     * @param typeProd type de Produit devant être supprimé.
     * @return boolean Retourne true si la suppression est un succès, false sinon.
     */
    public function delete(type $type)
    {
        $nbRows = 0;

        // le produit que nous essayons de supprimer existe-t-il dans la  base de données ?
        if ($prod->getNum()!=''){                    
            $query = "select count(*) as nb from `typeProd` where `numTypeProd`=?";
            $traitement = $this->db->prepare($query);
            $param1 = $type->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }

    }

    /**
     * Sélectionne un(des) type(s) de produit(s) dans la base.
     * 
     * Méthode générique de SELECT qui renvoie un tableau de type produit correspondant aux critères de sélection spécifiés.
     * Si aucun paramètre n'est précisé, la valeur par défaut du paramètre 'WHERE 1' permet d'obtenir tous les produits.
     * 
     * @param string Chaîne de caractère devant être une restriction SQL valide.
     * @return array Renvoie un tableau d'objet(s) type produit.
     */
    public function getList($restriction='WHERE 1')
    {
        $query = "select * from `typeProd` ".$restriction.";";
        $typeProdList = Array();

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
            $type = new typeProd($row['numTypeProd'],$row['libType']);            
            //ajout de l'objet à la fin du tableau
            $typeProdList[] = $type;
        }
        //retourne le tableau d'objets 'produit'
        return $typeProdList;   
    }
    
    /**
     * Sélectionne un produit dans la base.
     * 
     * Méthode de SELECT qui renvoie le produit dont l'id est spécifié en paramètre.
     * 
     * @param int ID du produit recherché
     * @return typeProd|boolean Renvoie l'objet produit recherché ou FALSE s'il n'a pas été trouvé
     */
    public function get($num)
    {
        $query = "select * from `typeProd` WHERE `numTypeProd`=?;";

        //Connection et execution de la requete
        try
        {
            $traitement = $this->db->prepare($query);
            $traitement->bindparam(1,$id);
            $traitement->execute();
        }
        catch(PDOException $e)
        {
            die ("Erreur : ".$e->getMessage());
        }

        //On récupère la première et seule ligne du jeu d'enregistrement	
        if ($row = $traitement->fetch()) {
            //On instancie un objet 'produit' avec les valeurs récupérées
            $type = new typeProd($row['numTypeProd'],$row['libType']);
            //retourne l'objet 'produit' correpsondant
            return $type;
        }
        else {
            return false;
        }
    }
    
}
