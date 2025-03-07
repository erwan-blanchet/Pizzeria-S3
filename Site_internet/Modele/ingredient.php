<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe des ingrédients. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class INGREDIENT extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected static string $identifiant = "idIngredient";
    protected static string $classe = "INGREDIENT";
    protected int $idIngredient;
    protected string $NomIngredient;
    protected int $PrixAchatIngredient;
    protected DATE $DateAchatIngredient;
    protected ?int $QuantiteEnStockIngredient;
    protected ?string $PhotoIngredient;

    

    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $idIngredient = NULL, string $NomIngredient = NULL, int $PrixAchatIngredient = NULL, DATE $DateAchatIngredient = NULL, int $QuantiteEnStockIngredient = NULL, string $PhotoIngredient = NULL){
      if(!is_null($idIngredient)){
        $this->idIngredient = $idIngredient;
        $this->NomIngredient = $NomIngredientt;
        $this->PrixAchatIngredient = $PrixAchatIngredient;
        $this->DateAchatIngredient = $DateAchatIngredient;
        $this->QuantiteEnStockIngredient = $QuantiteEnStockIngredient;
        $this->PhotoIngredient = $PhotoIngredient;
      }
    }



    //------------------------
    // METHODES
    //------------------------
    public function __toString(){
      $chaine = "$this->NomIngredient a été acheté $this->PrixAchatIngredient € le $this->DateAchatIngredient. Il en reste $this->QuantiteEnStockIngredient en stock.";
      if (is_null($this->idIngredient)){
        $chaine = "Cet ingrédient ne figure pas dans notre base de données.";
      }
      else {
          $chaine = "L'ingredient $this->NomIngredient a été acheté $this->PrixAchatIngredient € le $this->DateAchatIngredient. Il en reste $this->QuantiteEnStockIngredient en stock.";
      }
      return $chaine;
    }


    /**
     * Afficher les ingrédients en stock
     */
    public static function getIngredientStock(){
      // Préparer la requête
      $requetePreparee = "SELECT INGREDIENT.idIngredient, INGREDIENT.NomIngredient, INGREDIENT.PhotoIngredient, INGREDIENT.QuantiteEnStockIngredient FROM INGREDIENT ORDER BY INGREDIENT.NomIngredient ASC;";
      // Connexion à la base de données
      $resultat = connexion::pdo()->prepare($requetePreparee);
      try {
        // Exécuter la requête
        $resultat->execute();
        // Définir le mode de récupération
        $resultat->setFetchMode(PDO::FETCH_CLASS, 'INGREDIENT'); 
        // Récupérer les pizzas correspondantes
        $ingredients = $resultat->fetchAll(); 
        // Retourner le résultat
        return $ingredients;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Afficher les ingrédients en stock dans l'ordre inverse alphabétique.
     * @param array $ingredients Les ingrédients.
     */
    public static function getIngredientStockInverse(){
      // Préparer la requête
      $requetePreparee = "SELECT INGREDIENT.idIngredient, INGREDIENT.NomIngredient, INGREDIENT.PhotoIngredient, INGREDIENT.QuantiteEnStockIngredient FROM INGREDIENT ORDER BY INGREDIENT.NomIngredient DESC;";
      // Connexion à la base de données
      $resultat = connexion::pdo()->prepare($requetePreparee);
      try {
        // Exécuter la requête
        $resultat->execute();
        // Définir le mode de récupération
        $resultat->setFetchMode(PDO::FETCH_CLASS, 'INGREDIENT'); 
        // Récupérer les ingrédients correspondantes
        $ingredients = $resultat->fetchAll(); 
        // Retourner le résultat
        return $ingredients;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Afficher les ingrédients en stock par prix croissant.
     * @param array $ingredients Les ingrédients.
     */
    public static function getIngredientStockCroissant(){
      // Préparer la requête
      $requetePreparee = "SELECT INGREDIENT.idIngredient, INGREDIENT.NomIngredient, INGREDIENT.PhotoIngredient, INGREDIENT.PrixAchatIngredient, INGREDIENT.QuantiteEnStockIngredient FROM INGREDIENT ORDER BY INGREDIENT.QuantiteEnStockIngredient ASC;";
      // Connexion à la base de données
      $resultat = connexion::pdo()->prepare($requetePreparee);
      try {
        // Exécuter la requête
        $resultat->execute();
        // Définir le mode de récupération
        $resultat->setFetchMode(PDO::FETCH_CLASS, 'INGREDIENT'); 
        // Récupérer les ingrédients correspondantes
        $ingredients = $resultat->fetchAll(); 
        // Retourner le résultat
        return $ingredients;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Afficher les ingrédients en stock par prix décroissant.
     * @param array $ingredients Les ingrédients.
     */
    public static function getIngredientStockDeroissant(){
      // Préparer la requête
      $requetePreparee = "SELECT INGREDIENT.idIngredient, INGREDIENT.NomIngredient, INGREDIENT.PhotoIngredient, INGREDIENT.PrixAchatIngredient, INGREDIENT.QuantiteEnStockIngredient FROM INGREDIENT ORDER BY INGREDIENT.QuantiteEnStockIngredient DESC;";
      // Connexion à la base de données
      $resultat = connexion::pdo()->prepare($requetePreparee);
      try {
        // Exécuter la requête
        $resultat->execute();
        // Définir le mode de récupération
        $resultat->setFetchMode(PDO::FETCH_CLASS, 'INGREDIENT'); 
        // Récupérer les ingrédients correspondantes
        $ingredients = $resultat->fetchAll(); 
        // Retourner le résultat
        return $ingredients;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Récupréer les détails d'un ingrédient
     * @param int $id L'identifiant de l'ingrédient.
     * @return array $details Les détails de l'ingrédients.
     */
    public static function getDetailIngredient($id){
      // Préparer la requête
      $requetePreparee = "SELECT INGREDIENT.idIngredient, INGREDIENT.NomIngredient, INGREDIENT.PhotoIngredient, INGREDIENT.PrixAchatIngredient, INGREDIENT.QuantiteEnStockIngredient, INGREDIENT.DateAchatIngredient, FOURNISSEUR.NomFournisseur FROM INGREDIENT INNER JOIN est_fournit ON est_fournit.IngredientRecherche = INGREDIENT.idIngredient INNER JOIN FOURNISSEUR ON FOURNISSEUR.idFournisseur = est_fournit.FournisseurDeIngredient WHERE INGREDIENT.idIngredient = :id_tag;";
      // Connexion à la base de données
      $resultat = connexion::pdo()->prepare($requetePreparee);
      // Définir la valeur du paramètre
      $tags = array(":id_tag" => $id);
      try {
        // Exécuter la requête
        $resultat->execute($tags);
        // Récupérer les pizzas correspondantes
        $detailsPizza = $resultat->fetch(PDO::FETCH_ASSOC);
        // Retourner le résultat
        return $detailsPizza;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Créer une alerte
     * @param string $nom Le nom de l'alerte
     * @param int $quantiteMinimum La quantité minimum
     * @param int $id L'identifiant du produit 
     */
    public static function creerAlerteIngredient($nom, $quantiteMinimum, $id){
      // Préparer la requête d'insertion
      $requeteAlerte = "CREATE OR REPLACE TRIGGER {$nom} AFTER UPDATE ON INGREDIENT FOR EACH ROW BEGIN DECLARE alertMessage VARCHAR(255); IF (NEW.idIngredient = :id_tag AND NEW.QuantiteEnStockIngredient<= :nb_tag) THEN SET alertMessage = CONCAT(NEW.NomIngredient, ' nécessite un réapprovisionnement'); SIGNAL SQLSTATE '25007' SET MESSAGE_TEXT = alertMessage; END IF; END;//";      
      try {
        // Connexion à la base de données
        $alerte = connexion::pdo()->prepare($requeteAlerte);
        // Définir la valeur du paramètre
        $tags = array(":nb_tag" => $quantiteMinimum, ":id_tag" => $id);
        // Exécuter la requête
        $alerte->execute($tags);
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Récupérer les ingrédients.
     * @return array $ingredients Les ingrédients.
     */
    public static function getIngredients(){
      // Préparer la requête
      $requetePreparee = "SELECT DISTINCT INGREDIENT.idIngredient, INGREDIENT.NomIngredient FROM INGREDIENT WHERE INGREDIENT.QuantiteEnStockIngredient >= 1";
      // Connexion à la base de données
      $resultat = connexion::pdo()->prepare($requetePreparee);
      try {
        // Exécuter la requête
        $resultat->execute();
        // Récupérer les pizzas correspondantes
        $ingredients = $resultat->fetchAll(PDO::FETCH_ASSOC);
        // Retourner le résultat
        return $ingredients;
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }

    /**
     * Afficher les alertes sur ingredient
     */
    public static function afficherAlerteIngredient(){
      // Préparer la requête
      $requetePreparee = "SHOW TRIGGERS LIKE 'PRODUIT';";
      // Connexion à la base de données
      $resultat = connexion::pdo()->prepare($requetePreparee);
      try {
          // Exécuter la requête
          $resultat->execute();
          // Récupérer le résultat
          $triggers = $resultat->fetchAll(PDO::FETCH_ASSOC); 
          // Retourner le résultat
          return $triggers;
      } catch (PDOException $e) {
          // Afficher l'erreur
          echo $e->getMessage();
      }
    }

    /**
	 * Créer un ingrédient par le gestionnaire.
	 * @param string $nom Le nom de l'ingrédient.
	 * @param int $prix Le prix de l'ingrédient.
	 */
    public static function creerIngredientGestionnaire($nom, $prix){
      // Préparer la requête d'insertion
      $requeteInsertion = "INSERT INTO INGREDIENT (NomIngredient, PrixAchatIngredient, DateAchatIngredient) VALUES (:nom_tag, :prix_tag , CUREDATE());";      
      // Connexion à la base de données
      $insertion = connexion::pdo()->prepare($requeteInsertion);
      // Définir la valeur du paramètre
      $tags = array(":nom_tag" => $nom, ":prix_tag" => $prix);
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
     * Supprimer un ingredient par le gestionnaire.
     * @param int $id L'identifiant de l'ingredient.
     */
    public static function supprimerIngredientGestionnaire($id){
      // Préparer la requête d'insertion
      $requeteInsertion = "DELETE FROM INGREDIENT WHERE INGREDIENT.idIngredient = :id_tag;";      
      // Connexion à la base de données
      $insertion = connexion::pdo()->prepare($requeteInsertion);
      // Définir la valeur du paramètre
      $tags = array(":id_tag" => $nom);
      try {
        // Exécuter la requête
        $insertion->execute($tags);
      } 
      catch (PDOException $e) {
        // Afficher l'erreur
        echo $e->getMessage();
      }
    }
  }
?>

