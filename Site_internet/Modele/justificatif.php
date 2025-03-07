<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des justificatifs. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class JUSTIFICATIF extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idJustificatif";
    protected static string $classe = "JUSTIFICATIF";
    protected int $idJustificatif;
    protected string $Justification;
    protected int $PourcentageRemise;

  

    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idJustificatif = NULL, string $Justification = NULL, int $PourcentageRemise = NULL){
      if(!is_null($idJustificatif)){
        $this->idJustificatif = $idJustificatif;
        $this->Justification = $Justification;
        $this->PourcentageRemise = $PourcentageRemise;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      $chaine = "$this->Justification offre $this->PourcentageRemise %.";
      if (is_null($this->idJustificatif)){
        $chaine = "Ce justificatif ne figure pas dans notre base de données.";
      }
      else {
        $chaine = "Ce justificatif a pour identifiant $this->idJustificatif et pour raison : $this->Justification";
      }
      return $chaine;
    }
  }
?>