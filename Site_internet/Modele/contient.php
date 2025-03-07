<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe qui fait le lien entre les produits et leurs allergènes. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class contient extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected int $ProduitAvecAllergene;
    protected int $AllergeneImplique;



    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $ProduitAvecAllergene = NULL, int $AllergeneImplique = NULL){
      if((!is_null($ProduitAvecAllergene)  && (!is_null($AllergeneImplique))){
        $this->ProduitAvecAllergene = $ProduitAvecAllergene;
        $this->AllergeneImplique = $AllergeneImplique;
      }
    }    
  }
?>


