<?php
/**
 * Classe représentant les produits.
 * 
 * Les produits sont définis par
 *      <br>- un num unique
 *      <br>- un libellé
 * 
 * @author Nina
 */
class typeProd implements JsonSerializable {
    private $num;
    private $lib;

    /**
     * Instancie un objet produit.
     * 
     * @param type Libellé du produit
     *
     */    
    public function __construct($num,$lib){
        //on met pas l'id dans le constructeur
        $this->num = $num;
        $this->lib = $lib;
    }    

    // Mutateurs chargés de modifier les attributs
    public function setNum($num){$this->num = $num;}    
    public function setLib($lib){$this->lib = $lib;}
    
    // Accesseurs chargés d'exposer les attributs
    public function getNum(){return $this->num;}
    public function getLib(){return $this->lib;}
    
    /**
     * Spécifie les données qui doivent être linéarisées en JSON.
     * 
     * Linéarise l'objet en une valeur qui peut être linéarisé nativement par la fonction json_encode().
     * 
     * @return mixed Retourne les données qui peuvent être linéarisées par la fonction json_encode()
     */
    public function jsonSerialize() {
        return [
            'numTypeProd' => $this->num,
            'libType' => $this->lib
        ];
    }
    
}
