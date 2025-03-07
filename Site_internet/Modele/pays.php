<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des pays. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class PAYS extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idPays";
    protected static string $classe = "PAYS";
    protected int $idPays;
    protected string $nomPays;



    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idPays = NULL, string $pays = NULL){
      if(!is_null($idPays)){
        $this->idPays = $idPays;
        $this->nomPays = $pays;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      $chaine = "$this->nomPays";
      if (is_null($this->idPays)){
         $chaine = "Le pays ne figure pas dans notre base de données.";
      }
      return $chaine;
    }

    /**
     * Créer un pays.
     * @param string $nom Le nom du pays.
     */
    public static function creerPays($nom){
      // Préparer la requête d'insertion
      $requeteInsertion = "INSERT INTO PAYS (NomPays) VALUES (:nom_tag);";      
      // Connexion à la base de données
      $insertion = connexion::pdo()->prepare($requeteInsertion);
      // Définir la valeur du paramètre
      $tag = array(":nom_tag" => $nom);
      try {
        // Exécuter la requête
        $insertion->execute($tag);
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Renvoyer le numéro du pays.
     * @param string $nom Le nom du pays.
     * @return int L'identifiant du pays.
     */
    public static function getNumeroPays($nom) {
      // Préparer la requête
      $requetePreparee = "SELECT PAYS.idPays FROM PAYS WHERE nomPays = :nom_tag;";
      // Récupérer la requête préparer
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $valeurs = array(":nom_tag" => $nom);
      // Executer la réquête
      $recuperer_requete->execute($valeurs);
      // Définir le type d'affichage
      $recuperer_requete->setFetchMode(PDO::FETCH_CLASS,"PAYS");
      // Récupérer le résultat renvoyer 
      $tabPays = $recuperer_requete->fetchAll();
      // Si aucune valeur
      if(empty($tabPays)){
        // Renvoyer null
        return null;
      }
      // Sélectionner l'identifiant du premier objet du tableau
      $idPays = $tabPays[0]->idPays;
      // Renvoyer l'identifiant
      return $idPays;
    }

    /**
     * Savoir si le pays est déjà présent dans la base de données.
     * @param string $nom Le nom du pays.
     * @return boolean $paysExiste True si le pays est déjà présent, false sinon.
     */
    public static function paysExiste($nom) {
      // Préparer la requête
      $requetePreparee = "SELECT PAYS.idPays FROM PAYS WHERE nomPays = :nom_tag;";
      // Récupérer la requête préparée
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $valeurs = array(":nom_tag" => $nom);
      // Exécuter la requête
      $recuperer_requete->execute($valeurs);
      // Récupérer le résultat renvoyé 
      $nombreLignes = $recuperer_requete->fetchColumn();
      // Si la requête renvoie plus d'une ligne
      if ($nombreLignes > 0) {
        // Alors le pays existe
        $paysExiste = true;
      } else {
        // Si non, le pays n'existe pas
        $paysExiste = false;
      }
      // Renvoyer le boolean
      return $paysExiste;
    }
  }
?>