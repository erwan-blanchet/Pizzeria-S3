<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe qui fait le lien entre les livreurs et les commandes qu'ils doivent livrer. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class livre extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected int $CommandeALivre;
    protected int $LivreurCharge;



    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $CommandeALivre = NULL, int $LivreurCharge = NULL){
      if((!is_null($CommandeALivre)  && (!is_null($LivreurCharge))){
        $this->CommandeALivre = $CommandeALivre;
        $this->LivreurCharge = $LivreurCharge;
      }
    }
  }
?>


