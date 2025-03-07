<?php
  // Faire le lien avec le fichier mère
  require_once("objet.php");

  /**
  * Classe qui fait le lien entre les ingrédients et une pizza. C'est une classe fille d'objet.
  * @author Estelle BOISSERIE
  */
  class compose_de extends objet{
    //------------------------
    // ATTRIBUTS
    //------------------------
    protected int $RecettePizza;
    protected int $IngredientNecessaire;
    protected int $QuantiteDeIngredient;


    //------------------------
    // CONSTRUCTEUR
    //------------------------
    public function __construct(int $RecettePizza = NULL, int $IngredientNecessaire = NULL, int $QuantiteDeIngredient = NULL){
      if(!is_null($RecettePizza) && !is_null($IngredientNecessaire)) {
        $this->RecettePizza = $RecettePizza;
        $this->IngredientNecessaire = $IngredientNecessaire;
        $this->QuantiteDeIngredient = $QuantiteDeIngredient;
      }
    }
    



    //------------------------
    // METHODE
    //------------------------
    /**
     * Créer une composition.
     * @param int $pizza La recette pizza.
     * @param int $ingredient L'ingrédient nécessaire.
     * @param int $quantite La quantite d'ingrédient.
     */
    public static function creerUneComposition($pizza, $ingredient, $quantite){
      // Préparer la requête d'insertion
      $requeteInsertion = "INSERT INTO compose_de (RecettePizza, IngredientNecessaire, QuantiteDeIngredient) VALUES (:idPizza_tag, :idIngredient_tag, :quantiteIngredient_tag);";      
      // Connexion à la base de données
      $insertion = connexion::pdo()->prepare($requeteInsertion);
      // Définir la valeur du paramètre
      $tags = array(":idPizza_tag" => $pizza, ":idIngredient_tag" => $ingredient, ":quantiteIngredient_tag" => $quantite);
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


