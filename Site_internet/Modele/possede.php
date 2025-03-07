<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe qui fait le lien entre les pizzas et leurs allergènes. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class possede extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected int $PizzaAvecAllerge;
    protected int $AllergeneConteu;



    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $PizzaAvecAllerge = NULL, int $AllergeneConteu = NULL){
      if((!is_null($PizzaAvecAllerge)  && (!is_null($AllergeneConteu))){
        $this->PizzaAvecAllerge = $PizzaAvecAllerge;
        $this->AllergeneConteu = $AllergeneConteu;
      }
    }
  }
?>


