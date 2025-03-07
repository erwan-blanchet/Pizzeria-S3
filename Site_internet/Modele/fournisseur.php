<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des fournisseurs. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  * @author Erwan BLANCHET
  */
  class FOURNISSEUR extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idFournisseur";
    protected static string $classe = "FOURNISSEUR";
    protected int $idFournisseur;
    protected string $NomFournisseur;
    protected ?string $TelephoneFournisseur;
    protected ?string $EmailFournisseur;
    protected ?string $SiteInternet;
    protected int $AdresseFournisseur;

    

    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idFournisseur = NULL, string $NomFournisseur = NULL, string $TelephoneFournisseur = NULL, string $EmailFournisseur = NULL, string $SiteInternet = NULL, int $AdresseFournisseur = NULL){
      if(!is_null($idFournisseur)){
        $this->idFournisseur = $idFournisseur;
        $this->NomFournisseur = $NomFournisseur;
        $this->TelephoneFournisseur = $TelephoneFournisseur;
        $this->EmailFournisseur = $EmailFournisseur;
        $this->SiteInternet = $SiteInternet;
        $this->AdresseFournisseur = $AdresseFournisseur;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      if (is_null($this->idFournisseur)){
        $chaine = "Ce fournisseur ne figure pas dans notre base de données.";
      }
      else {
        $chaine = "Le fournisseur $this->NomFournisseur ayant pour téléphone $this->TelephoneFournisseur et pour email $this->EmailFournisseur ainsi que pour site internet $this->SiteInternet a pour adresse $this->AdresseFournisseur";
      }
      return $chaine;
    }

    /**
     * Trouver un fourisseur d'un produit.
     * @param int $id L'identifiant du produit.
     * @return array $fournisseur Le fournisseur du produit.
     */
    public static function getFournisseur($id) {
      // Préparer la requête
      $requetePreparee = "SELECT FOURNISSEUR.idFournisseur, FOURNISSEUR.NomFournisseur, FOURNISSEUR.TelephoneFournisseur, FOURNISSEUR.EmailFournisseur, FOURNISSEUR.SiteInternet, ADRESSE.Numero, ADRESSE.SuffixeAdresse, ADRESSE.NomRue, ADRESSE.ComplementAdresse, VILLE.NomVille, VILLE.CodePostal, PAYS.NomPays FROM FOURNISSEUR INNER JOIN provient ON provient.FournisseurDuProduit = FOURNISSEUR.idFournisseur INNER JOIN PRODUIT ON PRODUIT.idProduit = provient.ProduitRecherche INNER JOIN ADRESSE ON ADRESSE.idAdresse = FOURNISSEUR.AdresseFournisseur INNER JOIN VILLE ON ADRESSE.VilleAdresse = VILLE.idVille INNER JOIN PAYS ON PAYS.idPays = VILLE.PaysVille WHERE PRODUIT.idProduit = :id_tag;";
      // Connexion à la base de données
      $resultat = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur du paramètre
      $tags = array("id_tag" => $id);
      try {
        // Exécuter la requête
        $resultat->execute($tags);
        // Récupérer les fournisseurs ou le fournisseur correspondants
        $fournisseur = $resultat->fetchAll(PDO::FETCH_ASSOC);
        // Retourner le résultat
        return $fournisseur;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Trouver un fourisseur d'un ingrédient.
     * @param int $id L'identifiant de l'ingrédient.
     * @return array $fournisseur Le fournisseur de l'ingrédient.
     */
    public static function getFournisseurIngredient($id) {
      // Préparer la requête
      $requetePreparee = "    SELECT FOURNISSEUR.idFournisseur, FOURNISSEUR.NomFournisseur, FOURNISSEUR.TelephoneFournisseur, FOURNISSEUR.EmailFournisseur, FOURNISSEUR.SiteInternet, ADRESSE.Numero, ADRESSE.SuffixeAdresse, ADRESSE.NomRue, ADRESSE.ComplementAdresse, VILLE.NomVille, VILLE.CodePostal, PAYS.NomPays FROM FOURNISSEUR INNER JOIN est_fournit ON est_fournit.FournisseurDeIngredient = FOURNISSEUR.idFournisseur INNER JOIN INGREDIENT ON INGREDIENT.idIngredient = est_fournit.IngredientRecherche INNER JOIN ADRESSE ON ADRESSE.idAdresse = FOURNISSEUR.AdresseFournisseur INNER JOIN VILLE ON ADRESSE.VilleAdresse = VILLE.idVille INNER JOIN PAYS ON PAYS.idPays = VILLE.PaysVille WHERE INGREDIENT.idIngredient = :id_tag;";
      // Connexion à la base de données
      $resultat = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur du paramètre
      $tags = array("id_tag" => $id);
      try {
        // Exécuter la requête
        $resultat->execute($tags);
        // Récupérer les fournisseurs ou le fournisseur correspondants
        $fournisseur = $resultat->fetchAll(PDO::FETCH_ASSOC);
        // Retourner le résultat
        return $fournisseur;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }
  }
?>


