<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des bons d'achat. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class bon_d_achat extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected int $Beneficiaire;
    protected int $Raison;
    protected boolean $Utilise



    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $Beneficiaire = NULL, int $Raison = NULL, boolean $Utilise = NULL){
      if(!is_null($Beneficiaire)  && !is_null($Raison)){
        $this->Beneficiaire = $Beneficiaire;
        $this->Raison = $Raison;
        $this->Utilise = $Utilise;
      }
    }
  }
?>


