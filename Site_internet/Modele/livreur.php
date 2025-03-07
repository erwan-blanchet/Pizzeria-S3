<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des livreurs. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class LIVREUR extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idLivreur";
    protected static string $classe = "LIVREUR";
    protected int $idLivreur;
    protected string $DisponibiliteLivreur
    protected int $SalaireLivreur;
    protected int $Capacite;
    protected int $IndividuLivreur;

    

    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idLivreur = NULL, string $DisponibiliteLivreur = NULL, int $SalaireLivreur = NULL, int $Capacite = NULL, int $IndividuLivreur = NULL){
      if(!is_null($idLivreur)){
        $this->idLivreur = $idLivreur;
        $this->DisponibiliteLivreur = $DisponibiliteLivreur;
        $this->SalaireLivreur = $SalaireLivreur;
        $this->Capacite = $Capacite;
        $this->IndividuLivreur = $IndividuLivreur;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      $chaine = "$this->DisponibiliteLivreur,$this->SalaireLivreur, $this->Capacite ";
      if (is_null($this->idLivreur)){
        $chaine = "Ce livreur ne figure pas dans notre base de données.";
      }
      else {
        $chaine = "Ce livreur a pour identifiant $this->idLivreur";
      }
      return $chaine;
    }
  }
?>

