<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe qui fait le lien entre les produits et leurs allergènes. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class provient extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected int $ProduitRecherche;
    protected int $FournisseurDuProduit;



    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $ProduitRecherche = NULL, int $FournisseurDuProduit = NULL){
      if((!is_null($ProduitRecherche)  && (!is_null($FournisseurDuProduit))){
        $this->ProduitRecherche = $ProduitRecherche;
        $this->FournisseurDuProduit = $FournisseurDuProduit;
      }
    }
  }
?>


