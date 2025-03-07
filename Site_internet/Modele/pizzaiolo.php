<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des pizzaiolos. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class PIZZAIOLO extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idPizzaiolo";
    protected static string $classe = "PIZZAIOLO";
    protected int $idPizzaiolo;
    protected string $DisponibilitePizzaiolo;
    protected int $SalairePizzaiolo;
    protected int $IndividuPizzaiolo;

    

    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idPizzaiolo = NULL, string $DisponibilitePizzaiolo = NULL, int $SalairePizzaiolo = NULL, int $IndividuPizzaiolo = NULL){
      if(!is_null($idPizzaiolo)){
        $this->idPizzaiolo = $idPizzaiolo;
        $this->DisponibilitePizzaiolo = $DisponibilitePizzaiolo;
        $this->SalairePizzaiolo = $SalairePizzaiolo;
        $this->IndividuPizzaiolo = $IndividuPizzaiolo;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      $chaine = "$this->DisponibilitePizzaiolo, $this->SalairePizzaiolo.";
      if (is_null($this->idPizzaiolo)){
        $chaine = "Ce pizzaiolo ne figure pas dans notre base de données.";
      }
      return $chaine;
    }
  }
?>

