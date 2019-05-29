
<?php

class departement implements JsonSerializable {
    private $numDepart="";
    private $libDepart="";

public function __construct($numDepart, $libDepart){
        $this->numDepart = $numDepart;
        $this->libDepart = $libDepart;
    }
    
    // Mutateurs chargés de modifier les attributs
    public function setNum($numDepart){$this->numDepart = $numDepart;}    
    public function setLib($libDepart){$this->libDepart = $libDepart;}
    
  
    
    // Accesseurs chargés d'exposer les attributs
    public function getNum(){return $this->numDepart;}
    public function getLib(){return $this->libDepart;}
    
    
    
    /**
     * Spécifie les données qui doivent être linéarisées en JSON.
     * 
     * Linéarise l'objet en une valeur qui peut être linéarisé nativement par la fonction json_encode().
     * 
     * @return mixed Retourne les données qui peuvent être linéarisées par la fonction json_encode()
     */
    public function jsonSerialize() {
        return [
            'numDepart' => $this->numDepart,
            'libDepart' => $this->libDepart
            ,
            
        ];
    }
}