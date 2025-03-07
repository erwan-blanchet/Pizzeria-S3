<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe qui fait le lien entre les allergies et un client. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class est_allergique extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected int $ClientAllergique;
    protected int $AllergieDuClient;


    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $ClientAllergique = NULL, int $AllergieDuClient = NULL){
      if((!is_null($ClientAllergique)  && (!is_null($AllergieDuClient))){
        $this->ClientAllergique = $ClientAllergique;
        $this->IngredientNecessaire = $AllergieDuClient;
      }
    }
  }
?>


