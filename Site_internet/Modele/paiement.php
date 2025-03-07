<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des paiments. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class PAIEMENT extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idPaiement";
    protected static string $classe = "PAIEMENT";
    protected int $idPaiement;
    protected int $Cryptogramme;
    protected DATE $DateDePeremption;
    protected string $NomPorteur;

    

    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idPaiement = NULL, int $Cryptogramme = NULL, DATE $DateDePeremption = NULL, string $NomPorteur = NULL){
      if(!is_null($idPaiement)){
        $this->idPaiement = $idPaiement;
        $this->Cryptogramme = $Cryptogramme;
        $this->DateDePeremption = $DateDePeremption;
        $this->NomPorteur = $NomPorteur;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      $chaine = "Le paiment numéro $this->idPaiement est celui de $this->NomPorteur . Le crytpogramme est $this->Cryptogramme . Attention la carte périme le $this->DateDePeremption .";
      if (is_null($this->idPaiement)){
        $chaine = "Le paiement ne figure pas dans notre base de données.";
      }
      return $chaine;
    }

    /**
     * Créer un paiment
     * @param $crypto Le cryptogramme
     * @param $date La date de péremption
     * @param $nom Le nom du porteur
     */
    public static function creerPaiement($crypto, $date, $nom){
      // Préparer la requête d'insertion
      $requeteInsertion = "INSERT INTO PAIEMENT (Cryptogramme, DateDePeremption, NomPorteur) VALUES (:crypto_tag, :date_tag , :nom_tag);";      
      // Connexion à la base de données
      $insertion = connexion::pdo()->prepare($requeteInsertion);
      // Définir la valeur du paramètre
      $tags = array(":crypto_tag" => $crypto, ":date_tag" => $date, ":nom_tag" => $nom);
      try {
        // Exécuter la requête
        $insertion->execute($tags);
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Trouver l'identifiant du paiement
     * @param int $crypto Le cryptogramme
     * @param date $date La date de péremption
     * @param string $nom Le nom du porteur
     */
    public static function getIdentifiantPaiement($crypto, $date, $nom){
      // Préparer la requête
      $requetePreparee = "SELECT PAIEMENT.idPaiement FROM PAIEMENT WHERE PAIEMENT.Cryptogramme = :crypto_tag AND PAIEMENT.DateDePeremption = :date_tag AND PAIEMENT.NomPorteur = :nom_tag;";
      // Récupérer la requête préparer
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $tags = array(":crypto_tag" => $crypto, ":date_tag" => $date, ":nom_tag" => $nom);
      // Executer la réquête
      $recuperer_requete->execute($tags);
      // Définir le type d'affichage
      $recuperer_requete->setFetchMode(PDO::FETCH_CLASS,"PAIEMENT");
      // Récupérer le résultat renvoyer 
      $tabPaiements= $recuperer_requete->fetchAll();
      // Sélectionner l'identifiant du premier objet du tableau
      $idPaiement = $tabPaiements[0]->idPaiement;
      // Si aucune valeur
      if(empty($tabPaiements)){
        // Renvoyer null
         return null;
      }
      // Renvoyer l'identifiant
      return $idPaiement;
    }
  }
?>