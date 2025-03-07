<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des allergènes. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class ALLERGENE extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idAllergene";
    protected static string $classe = "ALLERGENE";
    protected int $idAllergene;
    protected string $NomAllergene;
    protected int $ResponsableAjoutAllergene;


    
    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idAllergene = NULL, string $NomAllergene = NULL, int $ResponsableAjoutAllergene = NULL){
      if(!is_null($idAllergene)){
        $this->idAllergene = $idAllergene;
        $this->NomAllergene = $NomAllergene;
        $this->ResponsableAjoutAllergene = $ResponsableAjoutAllergene;
      }
    }



    //------------------------
    // METHODE
    //------------------------
    public function __toString(){
        $chaine = "$this->NomAllergene";
      if (is_null($this->idAllergene)){
        $chaine = "Cet allergène ne figure pas dans notre base de données.";
      }
      return $chaine;
    }
  }
?>


