<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des individus. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  * @author Erwan BLANCHET
  */
  class INDIVIDU extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idIndividu";
    protected static string $classe = "INDIVIDU";
    protected int $idIndividu;
    protected string $Nom;
    protected ?string $Prenom;
    protected string $AdresseMail;
    protected string $NumeroTelephone;
    protected string $MotDePasse;

  

    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idIndividu = NULL, string $Nom = NULL, string $Prenom = NULL, string $AdresseMail = NULL, string $NumeroTelephone = NULL, string $MotDePasse = NULL){
      if(!is_null($idIndividu)){
        $this->idIndividu = $idIndividu;
        $this->Nom = $Nom;
        $this->Prenom = $Prenom;
        $this->AdresseMail = $AdresseMail;
        $this->NumeroTelephone = $NumeroTelephone;
        $this->MotDePasse = $MotDePasse;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      if (is_null($this->idIndividu)){
        $chaine = "Cette persone ne figure pas dans notre base de données.";
      }
      elseif (is_null($this->Prenom)){
        $chaine = "$this->Nom a comme adresse mail $this->AdresseMail et comme numéro de téléphone $this->NumeroTelephone. Son mot de passe est $this->MotDePasse.";
      }
      else {
        $chaine = "$this->Nom $this->Prenom a comme adresse mail $this->AdresseMail et comme numéro de téléphone $this->NumeroTelephone. Son mot de passe est $this->MotDePasse.";
      }
      return $chaine;
    }

    /**
     * Vérfier la demande de connexion d'un individu selon son adresse mail et mot de passe.
     * @param string $mail L'adresse mail.
     * @param string $mdp Le mot de passe.
     * @return boolean True si c'est une connexion valide. Si non, False.
     */
    public static function verifierConnexion($mail,$mdp) {
      // Préparer la requête
      $requetePreparee = "SELECT * FROM INDIVIDU WHERE AdresseMail = :mail_tag and MotDePasse = :mdp_tag;";
      // Récupérer la requête préparer
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $valeurs = array( "mail_tag" => $mail, "mdp_tag" => $mdp);
      // Executer la réquête
      $recuperer_requete->execute($valeurs);
      // Définir le type d'affichage
      $recuperer_requete->setFetchMode(PDO::FETCH_CLASS,"INDIVIDU");
      // Récupérer le résultat renvoyer 
      $tabIndividus = $recuperer_requete->fetchAll();
      // S'il y a une connexion identique
      if (sizeof($tabIndividus) == 1) {
        // Retourner vrai
        return true;
      }
      // Si non
      else {
        // Retourner faux
        return false;
      }
    }

    /**
     * Renvoyer le numéro d'individu.
     * @param string $mail L'adresse mail de l'individu.
     * @param string $mdp Le mot de passe de l'individu.
     * @return int $idIndividu L'identifiant de l'individu.
     */
    public static function getNumeroIndividu($mail, $mdp) {
      // Préparer la requête
      $requetePreparee = "SELECT INDIVIDU.idIndividu FROM INDIVIDU WHERE AdresseMail = :mail_tag and MotDePasse = :mdp_tag;";
      // Récupérer la requête préparée
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $valeurs = array("mail_tag" => $mail, "mdp_tag" => $mdp);
      // Exécuter la requête
      $recuperer_requete->execute($valeurs);
      // Définir le type d'affichage
      $recuperer_requete->setFetchMode(PDO::FETCH_CLASS, "INDIVIDU");
      // Récupérer le résultat renvoyé 
      $tabIndividus = $recuperer_requete->fetchAll();
      // Si aucune valeur
      if (empty($tabIndividus)) {
          // Renvoyer null
          return null;
      }
      // Sélectionner l'identifiant du premier objet du tableau
      $idIndividu = $tabIndividus[0]->idIndividu;
      // Renvoyer l'identifiant
      return $idIndividu;
  }
  

    /**
     * Récupérer les informations sur le client.
     * @param int $id L'identifiant du client.
     * @return array infoClient Les informations sur le client.
     */
    public static function getInfoClient($id){
      // Préparer la requête
      $requetePreparee = "SELECT INDIVIDU.Nom, INDIVIDU.Prenom, INDIVIDU.AdresseMail, INDIVIDU.NumeroTelephone, INDIVIDU.MotDePasse, ADRESSE.Numero, ADRESSE.SuffixeAdresse, ADRESSE.NomRue, ADRESSE.ComplementAdresse, VILLE.NomVille, VILLE.CodePostal, PAYS.NomPays FROM INDIVIDU INNER JOIN CLIENT ON CLIENT.IndividuClient = INDIVIDU.idIndividu INNER JOIN ADRESSE ON CLIENT.AdresseClient = ADRESSE.idAdresse INNER JOIN VILLE ON ADRESSE.VilleAdresse = VILLE.idVille INNER JOIN PAYS ON VILLE.PaysVille = PAYS.idPays WHERE INDIVIDU.idIndividu = :id_tag;";
      // Récupérer la requête préparer
      $resultat = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $tag = array(":id_tag" => $id);
      try {
        // Exécuter la requête
        $resultat->execute($tag);
        // Définir le mode de récupération
        $infoClient = $resultat->fetch(PDO::FETCH_ASSOC);
        // Retourner le résultat
        return $infoClient;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    } 

  /**
     * Récupérer les informations sur le gestionnaire.
     * @param int $id L'identifiant du gestionnaire.
     * @return array infoGestionnaire Les informations sur le gestionnaire.
     */
    public static function getInfoGestionnaire($id){
      // Préparer la requête
      $requetePreparee = "SELECT INDIVIDU.Nom, INDIVIDU.Prenom, INDIVIDU.AdresseMail, INDIVIDU.NumeroTelephone, INDIVIDU.MotDePasse FROM INDIVIDU INNER JOIN GESTIONNAIRE ON GESTIONNAIRE.IndividuGestionnaire = INDIVIDU.idIndividu WHERE INDIVIDU.idIndividu = :id_tag;";
      // Récupérer la requête préparer
      $resultat = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $tags = array(":id_tag" => $id);
      try {
        // Exécuter la requête
        $resultat->execute($tags);
        // Définir le mode de récupération
        $infoGestionnaire = $resultat->fetch(PDO::FETCH_ASSOC);
        // Retourner le résultat
        return $infoGestionnaire;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    } 

    /**
     * Créer un individu.
     * @param string $nom Le nom de l'individu.
     * @param string $prenom Le prenom de l'individu.
     * @param string $mail L'adresse mail de l'individu.
     * @param string $telephone Le numéro de téléphone de l'individu.
     * @param string $mdp Le mot de passe de l'individu.
     * @param string $confirmationMDP La confirmation de mot de passe.
     */
    public static function creerIndividu($nom, $prenom, $mail, $telephone, $mdp, $confirmationMDP){
      // Si les mots de passe saisient sont les mêmes
      if ($mdp == $confirmationMDP){
        // Préparer la requête d'insertion
        $requeteInsertion = "INSERT INTO INDIVIDU (Nom, Prenom, AdresseMail, NumeroTelephone, MotDePasse) VALUES (:nom_tag, :prenom_tag, :mail_tag, :telephone_tag, :mdp_tag);";      
        // Connexion à la base de données
        $insertion = connexion::pdo()->prepare($requeteInsertion);
        // Définir la valeur du paramètre
        $tags = array(":nom_tag" => $nom, ":prenom_tag" => $prenom, ":mail_tag" => $mail, ":telephone_tag" =>$telephone, ":mdp_tag"=>$mdp);
        try {
          // Exécuter la requête
          $insertion->execute($tags);
        } 
        catch (PDOException $e) {
          // Afficher l'erreur
          echo $e->getMessage();
        }
      }
      else {
        // Ouvrir une fenêtre pop up informant de l'erreur de correspondance des mot de passe
        echo '<script>';
        echo 'function ouvrirPopup() {';
        echo 'window.open(\'./Vues/alerteCorrespondanceMDP.html\', \'Erreur de mot de passe\', \'width=500,height=400\');';
        echo '}';
        echo 'window.onload = ouvrirPopup;';
        echo '</script>';
        // Appelle de fichier 
        require_once("./Controlleurs/controlleurObjet.php");
        // Re-afficher la page de création de profil
        controlleurObjet::creationProfil();
        exit;
      }
    }

    /**
     * Savoir si l'individu est déjà présent dans la base de données.
     * @param string $mail L'adresse mail de l'individu.
     * @param string $mdp Le mot de passe de l'individu.
     * @return boolean $individuExiste True si l'individu est déjà présent, false sinon.
     */
    public static function individuExiste($mail, $mdp) {
      // Préparer la requête
      $requetePreparee = "SELECT INDIVIDU.idIndividu FROM INDIVIDU WHERE AdresseMail = :mail_tag and MotDePasse = :mdp_tag;";
      // Récupérer la requête préparer
      $recuperer_requete = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur des paramètres
      $tags = array( "mail_tag" => $mail, "mdp_tag" => $mdp);
      // Exécuter la requête
      $recuperer_requete->execute($tags);
      // Récupérer le résultat renvoyé 
      $nombreLignes = $recuperer_requete->fetchColumn();
      // Si la requête renvoie plus d'une ligne
      if ($nombreLignes > 0) {
        // Alors l'individu lle existe
        $individuExiste = true;
      } else {
        // Si non, l'individu n'existe pas
        $individuExiste = false;
      }
      // Renvoyer le boolean
      return $individuExiste;
    }
  }
?>