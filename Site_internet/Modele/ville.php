<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des villes. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  * @author Erwan BLANCHET
  */
  class VILLE extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idVille";
    protected static string $classe = "VILLE";
    protected int $idVille;
    protected string $NomVille;
    protected int $CodePostal;
    protected int $PaysVille;

    

    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idVille = NULL, string $NomVille = NULL, int $CodePostal = NULL, int $PaysVille = NULL){
      if(!is_null($idVille)){
        $this->idVille = $idVille;
        $this->NomVille = $NomVille;
        $this->CodePostal = $CodePostal;
        $this->PaysVille = $PaysVille;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      $chaine = "$this->NomVille , $this->CodePostal";
      if (is_null($this->idIngredient)){
        $chaine = "Cette ville ne figure pas dans notre base de données.";
      }
      else {
        $chaine = "La ville à pour nom : $this->NomVille, son code postal est : $this->CodePostal, son pays est : $this->PaysVille";
      }
      return $chaine;
    }

     /**
     * Créer une ville.
     * @param string $nom Le nom de la ville.
     * @param int $codePostal Le code postal de la ville.
     * @param int $idPays Le pays dans lequel est situé la ville.
     */
    public static function creerVille($nom, $codePostal, $idPays){
      // Préparer la requête d'insertion
      $requeteInsertion = "INSERT INTO VILLE (NomVille, CodePostal, PaysVille) VALUES (:nom_tag, :codePostal_tag, :idPays_tag);";      
      // Connexion à la base de données
      $insertion = connexion::pdo()->prepare($requeteInsertion);
      // Définir la valeur du paramètre
      $tags = array(":nom_tag" => $nom, ":codePostal_tag"=> $codePostal, ":idPays_tag" => $idPays);
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
     * Renvoyer le numéro d'une ville.
     * @param string $nom Le nom de la ville.
     * @param int $codePostal Le code postale de la ville.
     * @param int $id L'identifiant du pays.
     * @return int $idVille L'identifiant de la ville.
     */
    public static function getNumeroVille($nom, $codePostal, $id) {
      // Préparer la requête
      $requetePreparee = "SELECT VILLE.idVille FROM VILLE WHERE nomVille = :nom_tag AND codePostal = :codePostal_tag AND PaysVille = :id_tag;";
      // Récupérer la requête préparer
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $tags = array(":nom_tag" => $nom, ":codePostal_tag" => $codePostal, ":id_tag" => $id);
      // Executer la réquête
      $recuperer_requete->execute($tags);
      // Définir le type d'affichage
      $recuperer_requete->setFetchMode(PDO::FETCH_CLASS,"VILLE");
      // Récupérer le résultat renvoyer 
      $tabVilles = $recuperer_requete->fetchAll();
      // Si aucune valeur
      if(empty($tabVilles)){
        // Renvoyer null
        return null;
      }
      // Sélectionner l'identifiant du premier objet du tableau
      $idVille = $tabVilles[0]->idVille;
      // Renvoyer l'identifiant
      return $idVille;
    }

    /**
     * Savoir si la ville est déjà présent dans la base de données.
     * @param string $nom Le nom de la ville.
     * @param int $codePostal Le code pastal de la ville.
     * @param int $id Le pays où se situe la ville.
     * @return boolean $villeExiste True si la ville est déjà présent, false sinon.
     */
    public static function villeExiste($nom, $codePostal, $id) {
      // Préparer la requête
      $requetePreparee = "SELECT VILLE.idVille FROM VILLE WHERE nomVille = :nom_tag AND codePostal = :codePostal_tag AND PaysVille = :id_tag;";
      // Récupérer la requête préparée
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $tags = array(":nom_tag" => $nom, ":codePostal_tag" => $codePostal, ":id_tag" => $id);
      // Exécuter la requête
      $recuperer_requete->execute($tags);
      // Récupérer le résultat renvoyé 
      $nombreLignes = $recuperer_requete->fetchColumn();
      // Si la requête renvoie plus d'une ligne
      if ($nombreLignes > 0) {
        // Alors la ville existe
        $villeExiste = true;
      } else {
        // Si non, la ville n'existe pas
        $villeExiste = false;
      }
      // Renvoyer le boolean
      return $villeExiste;
    }
  }
?>

