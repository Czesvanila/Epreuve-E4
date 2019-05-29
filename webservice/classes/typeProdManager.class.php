<?php
require_once ("database.class.php");

class typeProdManager {
    
    private $db;
    
    /**
     * @param database Instance de la classe database.
     */
    public function __construct($database)
    {
        $this->db=$database;
    }    
    
    /**
     * Enregistre ou Modifie le produit dans la base.
     * 
     * @param typeProd 
     * 
     * @return int 
     */
    public function save(type $type)
    {        
        $nbRows = 0;

        if ($type->getNum()!=''){
            $query = "select count(*) as nb from `typeProd` where `numTypeProd`=?";
            $traitement = $this->db->prepare($query);
            $param1=$type->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        
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
     * @param typeProd 
     * @return boolean 
     */
    public function delete(type $type)
    {
        $nbRows = 0;

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
     * @param string 
     * @return array 
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

        while ($row = $result->fetch())
        {
            $type = new typeProd($row['numTypeProd'],$row['libType']);            
            $typeProdList[] = $type;
        }
        return $typeProdList;   
    }
    
    /**
     * 
     * @param int ID du produit recherché
     * @return typeProd|boolean Renvoie l'objet produit recherché ou FALSE s'il n'a pas été trouvé
     */
    public function get($num)
    {
        $query = "select * from `typeProd` WHERE `numTypeProd`=?;";

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

        if ($row = $traitement->fetch()) {
            $type = new typeProd($row['numTypeProd'],$row['libType']);
            return $type;
        }
        else {
            return false;
        }
    }
    
}
