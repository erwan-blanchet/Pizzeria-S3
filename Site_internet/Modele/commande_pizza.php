<?php
		// Faire le lien avec le fichier mère
		require_once("objet.php");

/**
 * Classe qui fait le lien entre les commandes et les pizzas commandées. C'est une classe fille d'objet.
 * @author Estelle BOISSERIE
 */
class commande_pizza extends objet{
	//------------------------
	// ATTRIBUTS
	//------------------------
	protected int $PizzaCommande;
	protected int $CommandeEffectue;
	protected int $QuantitePizza;
	protected ?String $CommentairePizza;
	protected String $StatusPizza;



	//------------------------
	// CONSTRUCTEUR
	//------------------------
	public function __construct(int $PizzaCommande = NULL, int $CommandeEffectue = NULL, int $QuantitePizza = NULL, String $CommentairePizza = NULL, String $StatusPizza = NULL){
		if (!is_null($PizzaCommande) && !is_null($CommandeEffectue)) {
			$this->PizzaCommande = $PizzaCommande;
			$this->CommandeEffectue = $CommandeEffectue;
			$this->QuantitePizza = $QuantitePizza;
			$this->CommentairePizza = $CommentairePizza;
			$this->StatusPizza = $StatusPizza;
		}
	}



	//------------------------
	// METHODES
	//------------------------
	/**
	 * Commander une pizza.
	 * @param int $idPizza L'identifiant d'une pizza.
	 * @param int $numeroPizza Le numéro de commande.
	 */
	public static function commanderPizza($idPizza, $numeroCommande){
		// Préparer la requête d'insertion
		$requeteInsertion = "INSERT INTO commande_pizza (PizzaCommande, CommandeEffectue, QuantitePizza, StatutPizza) VALUES (:id_tag , :num_tag, 1, 'En attente');";
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":id_tag" => $idPizza, ":num_tag" => $numeroCommande);
		try {
			// Exécuter la requête
			$insertion->execute($tags);
		} 
		catch (PDOException $e) {
			// Capturer l'erreur
			$erreur_du_trigger = $e->getMessage();
			// Stocker l'erreur dans une variable de session
			$_SESSION['alerte_trigger'] = $erreur_du_trigger;
		}
	}

	/**
	 * Ajuster la quantite de la commande pizza.
   * @param int $quantite La quantité de pizza.
   * @param int $pizza L'identifiant de la pizza.
   * @param int $commande L'identifiant de la commande.
	 */
	public static function ajusterQuantitePizza($quantite, $pizza, $commande){
		// Préparer la requête d'insertion
		$requeteInsertion = "UPDATE commande_pizza SET commande_pizza.QuantitePizza = :qtt_tag WHERE commande_pizza.PizzaCommande = :id_tag AND commande_pizza.CommandeEffectue = :num_tag;";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":qtt_tag" => $quantite, ":id_tag" => $pizza, ":num_tag" => $commande);
		try {
			// Exécuter la requête
			$insertion->execute($tags);
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();

			// Capturer l'erreur
			$erreur_du_trigger = $e->getMessage();

			// Stocker l'erreur dans une variable de session
			$_SESSION['alerte_trigger'] = $erreur_du_trigger;
		}
	}

	/**
	 * Supprimer une pizza d'une commande.
   * @param int $pizza L'identifiant de la pizza.
   * @param int $commande L'identifiant de la commande.
	 */
	public static function supprimerPizzaCommande($pizza, $commande){
		// Préparer la requête d'insertion
		$requeteInsertion = "DELETE FROM commande_pizza WHERE commande_pizza.PizzaCommande = :id_tag AND commande_pizza.CommandeEffectue = :num_tag;";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":id_tag" => $pizza, ":num_tag" => $commande);
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