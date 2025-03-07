<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des gestionnaires. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class GESTIONNAIRE extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idGestionnaire";
    protected static string $classe = "GESTIONNAIRE";
    protected int $idGestionnaire;
    protected int $SalaireGestionnaire;
    protected int $IndividuGestionnaire;

    
    
    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idGestionnaire = NULL, int $SalaireGestionnaire = NULL, int $IndividuGestionnaire = NULL){
      if(!is_null($idGestionnaire)){
        $this->idGestionnaire = $idGestionnaire;
        $this->SalaireGestionnaire = $SalaireGestionnaire;
        $this->IndividuGestionnaire = $IndividuGestionnaire;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      if (is_null($this->idGestionnaire)){
        $chaine = "Ce client ne figure pas dans notre base de données.";
      }
      $chaine = "Le gestionnaire a un salaire de ".$this->SalaireGestionnaire."€";
      return $chaine;
    }

    /**
     * Vérifier si l'individu est un gestionnaire.
     * @param string $mail L'adresse mail.
     * @param string $mdp Le mot de passe.
     * @return boolean True si c'est un gestionnaire. False si ce n'est pas un gestionnaire.
     */
    public static function estGestionnaire($mail, $mdp) {
      // Récupérer le numIndividu
      $id = individu::getNumeroIndividu($mail, $mdp);
      // Préparer la requête
      $requetePreparee = "SELECT GESTIONNAIRE.idGestionnaire FROM GESTIONNAIRE WHERE IndividuGestionnaire = :id_tag;";
      // Récupérer la requête préparer
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $valeur = array("id_tag" => $id);
      // Executer la réquête
      $recuperer_requete->execute($valeur);
      // Définir le type d'affichage
      $recuperer_requete->setFetchMode(PDO::FETCH_CLASS,"GESTIONNAIRE");
      // Récupérer le résultat renvoyer 
      $tabGestionnaires= $recuperer_requete->fetchAll();
      // Si aucune valeur
      if(empty($tabGestionnaires)){
        // Renvoyer null
        return False;
      }
      // Renvoyer l'identifiant
      return True;
    }

    /**
     * Renvoyer le numéro du gestionnaire.
     * @param string $mail L'adresse mail de l'individu.
     * @param string $mdp Le mot de passe de l'individu.
     * @return int $idGestionnaires L'identifiant du gestionnaire.
     */
    public static function getNumeroGestionnaire($mail, $mdp) {
      // Récupérer le numIndividu
      $id = individu::getNumeroIndividu($mail, $mdp);
      // Préparer la requête
      $requetePreparee = "SELECT GESTIONNAIRE.idGestionnaire FROM GESTIONNAIRE WHERE IndividuGestionnaire = :id_tag;";
      // Récupérer la requête préparer
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $tag = array("id_tag" => $id);
      // Executer la réquête
      $recuperer_requete->execute($tag);
      // Définir le type d'affichage
      $recuperer_requete->setFetchMode(PDO::FETCH_CLASS,"GESTIONNAIRE");
      // Récupérer le résultat renvoyer 
      $tabGestionnaires= $recuperer_requete->fetchAll();
      // Sélectionner l'identifiant du premier objet du tableau
      $idGestionnaires = $tabGestionnaires[0]->idGestionnaire;
      // Si aucune valeur
      if(empty($tabGestionnaires)){
        // Renvoyer null
        return null;
      }
      // Renvoyer l'identifiant
      return $idGestionnaires;
    }

    /**
     * Créer un gestionnaire.
     * @param int $idIndividu L'identifiant de l'individu gestionnaire.
     */
    public static function creerGestionnaire($idIndividu){
      // Préparer la requête d'insertion
      $requeteInsertion = "INSERT INTO GESTIONNAIRE (SalaireGestionnaire, IndividuGestionnaire) VALUES (1767, :idIndividu_tag);";      
      // Connexion à la base de données
      $insertion = connexion::pdo()->prepare($requeteInsertion);
      // Définir la valeur du paramètre
      $tags = array(":idIndividu_tag" => $idIndividu);
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
     * Savoir si le gestionnaire est déjà présent dans la base de données.
     * @param int $idIndividu L'identifiant de l'individu gestionnaire.
     * @return boolean $gestionnaireExiste True si le gestionnaire est déjà présent, false sinon.
     */
    public static function gestionnaireExiste($idIndividu) {
      // Préparer la requête
      $requetePreparee = "SELECT GESTIONNAIRE.idGestionnaire FROM GESTIONNAIRE WHERE GESTIONNAIRE.IndividuGestionnaire = :idIndividu_tag;";
      // Récupérer la requête préparer
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $tags = array( ":idIndividu_tag" => $idIndividu);
      // Exécuter la requête
      $recuperer_requete->execute($tags);
      // Récupérer le résultat renvoyé 
      $nombreLignes = $recuperer_requete->fetchColumn();
      // Si la requête renvoie plus d'une ligne
      if ($nombreLignes > 0) {
        // Alors le gestionnaire existe
        $gestionnaireExiste = true;
      } else {
        // Si non, le gestionnaire n'existe pas
        $gestionnaireExiste = false;
      }
      // Renvoyer le boolean
      return $gestionnaireExiste;
    }
  }
?>



