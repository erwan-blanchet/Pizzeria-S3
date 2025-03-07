<?php
		// Faire le lien avec le fichier mère
		require_once("objet.php");

/**
 * Classe des pizzas. C'est une classe fille d'objet.
 * @author Estelle BOISSERIE
 */
class PIZZA extends objet{
	//------------------------
	// ATTRIBUTS
	//------------------------
	protected static string $identifiant = "idPizza";
	protected static string $classe = "PIZZA";
	protected int $idPizza;
	protected string $NomPizza;
	protected ?string $DescriptionPizza;
	protected ?string $Theme;
	protected ?int $MargePizza;
	protected ?int $PrixPizza;
	protected ?int $AjoutGestionnaire;
	protected ?int $Createur;
	protected ?string $PhotoPizza;



	//------------------------
	// CONSTRUCTEUR
	//------------------------
	public function __construct(int $idPizza = NULL, string $NomPizza = NULL, string $DescriptionPizza = NULL, string $Theme = NULL, int $MargePizza = NULL, int $PrixPizza = NULL, int $AjoutGestionnaire = NULL, int $Createur = NULL, string $PhotoPizza = NULL){
		if(!is_null($idPizza)){
			$this->idPizza = $idPizza;
			$this->NomPizza = $NomPizza;
			$this->DescriptionPizza = $DescriptionPizza;
			$this->Theme = $Theme;
			$this->MargePizza = $MargePizza;
			$this->PrixPizza = $PrixPizza;
			$this->AjoutGestionnaire = $AjoutGestionnaire;
			$this->Createur = $Createur;
			$this->PhotoPizza = $PhotoPizza;
		}
	}



	//------------------------
	// METHODES
	//------------------------
	public function __toString(){
		if (is_null($this->idPizza) || is_null($this->NomPizza) || is_null($this->Theme) || is_null($this->PrixPizza)){
			$chaine = "Cette pizza ne figure pas dans notre base de données.";
		}
		else {
			$chaine = "La pizza $this->NomPizza fait partie du thème $this->Theme avec un prix de $this->PrixPizza €.";
		}
		return $chaine;
	}


	/**
	 * Avoir la liste des pizza selon un thème.
	 * @param string $thème Le thème de la pizza.
	 * @return array $pizzas Le tableau de pizza dont le thème correspond.
	 */
	public static function getPizzaALaUne($theme) {
		// Préparer la requête
		$requetePreparee = "SELECT * FROM PIZZA WHERE PIZZA.Createur is NULL AND Theme = :theme_tag;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur du paramètre
		$tags = array("theme_tag" => $theme);
		try {
			// Exécuter la requête
			$resultat->execute($tags);
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PIZZA'); 
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(); 
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les pizzas dans l'ordre alphabétique
	 * @return array $pizzas Le tableau de pizza
	 */
	public static function getPizzaAlphabetique() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PIZZA.idPizza, PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM PIZZA INNER JOIN compose_de ON PIZZA.idPizza = compose_de.RecettePizza INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient WHERE PIZZA.Createur is NULL GROUP BY PIZZA.idPizza, INGREDIENT.idIngredient HAVING MIN(INGREDIENT.QuantiteEnStockIngredient / compose_de.QuantiteDeIngredient) >= 1 ORDER BY PIZZA.NomPizza ASC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PIZZA'); 
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(); 
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les pizzas dans l'ordre inverse alphabétique
	 * @return array $pizzas Le tableau de pizza
	 */
	public static function getPizzaInverseAlphabetique() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PIZZA.idPizza, PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM PIZZA INNER JOIN compose_de ON PIZZA.idPizza = compose_de.RecettePizza INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient WHERE PIZZA.Createur is NULL GROUP BY PIZZA.idPizza, INGREDIENT.idIngredient HAVING MIN(INGREDIENT.QuantiteEnStockIngredient / compose_de.QuantiteDeIngredient) >= 1 ORDER BY PIZZA.NomPizza DESC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PIZZA'); 
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(); 
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les pizzas dans l'ordre croissant des prix
	 * @return array $pizzas Le tableau de pizza
	 */
	public static function getPizzaPrixCroissant() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PIZZA.idPizza, PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM PIZZA INNER JOIN compose_de ON PIZZA.idPizza = compose_de.RecettePizza INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient WHERE PIZZA.Createur is NULL GROUP BY PIZZA.idPizza, INGREDIENT.idIngredient HAVING MIN(INGREDIENT.QuantiteEnStockIngredient / compose_de.QuantiteDeIngredient) >= 1 ORDER BY PIZZA.PrixPizza ASC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PIZZA'); 
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(); 
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les pizzas dans l'ordre décroissant des prix
	 * @return array $pizzas Le tableau de pizza
	 */
	public static function getPizzaPrixDecroissant() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PIZZA.idPizza, PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM PIZZA INNER JOIN compose_de ON PIZZA.idPizza = compose_de.RecettePizza INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient WHERE PIZZA.Createur is NULL GROUP BY PIZZA.idPizza, INGREDIENT.idIngredient HAVING MIN(INGREDIENT.QuantiteEnStockIngredient / compose_de.QuantiteDeIngredient) >= 1 ORDER BY PIZZA.PrixPizza DESC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PIZZA'); 
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(); 
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Récupérer les détails d'une pizza selon son identifiant.
	 * @param int $id L'identifiant de la pizza.
	 * @return array $pizzas Les détails de la pizza.
	 */
	public static function getDetailPizza($id) {
		// Préparer la requête 
		$requetePreparee = "SELECT DISTINCT PIZZA.idPizza, PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.Theme, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM PIZZA WHERE PIZZA.idPizza = :id_tag;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur du paramètre
		$tags = array("id_tag" => $id);
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
	 * Récupérer les ingrédients d'une pizza selon son identifiant.
	 * @param int $id L'identifiant de la pizza.
	 * @return array $pizzas Les ingrédients de la pizza.
	 */
	public static function getIngredientPizza($id) {
		// Préparer la requête 
		$requetePreparee = "SELECT DISTINCT compose_de.QuantiteDeIngredient, INGREDIENT.idIngredient, INGREDIENT.NomIngredient, INGREDIENT.QuantiteEnStockIngredient FROM compose_de INNER JOIN PIZZA ON PIZZA.idPizza = compose_de.RecettePizza INNER JOIN INGREDIENT ON INGREDIENT.idIngredient = compose_de.IngredientNecessaire WHERE PIZZA.idPizza = :id_tag;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur du paramètre
		$tags = array("id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tags);
			// Récupérer les pizzas correspondantes
			$ingredientsPizza = $resultat->fetchAll(); 
			// Retourner le résultat
			return $ingredientsPizza;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Créer une pizza.
	 * @param string $nom Le nom de la pizza.
	 * @param string $description La description de la pizza.
	 * @param int $createur L'identifiant du créateur de la pizza.
	 */
	public static function creerPizzaPerso($nom, $description, $createur){
		// Préparer la requête d'insertion
		$requeteInsertion = "INSERT INTO PIZZA (NomPizza, DescriptionPizza, Createur) VALUES (:nomPizza_tag, :descriptionPizza_tag , :idCreateur_tag );";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":nomPizza_tag" => $nom, ":descriptionPizza_tag" => $description, ":idCreateur_tag" => $createur);
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
	 * Renvoyer l'identifiant de la pizza.
	 * @param string $nom Le nom de la pizza.
	 * @param int $id L'identifiant du créateur.
	 * @return int $idPizza L'identifiant de la pizza
	 */
	public static function getNumeroPizza($nom, $idCreateur) {
		// Préparer la requête
		$requetePreparee = "SELECT PIZZA.idPizza FROM PIZZA WHERE PIZZA.Createur = :idCreateur_tag AND PIZZA.NomPizza = :nomPizza_tag;";
		// Récupérer la requête préparée
		$recuperer_requete = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tags = array(":idCreateur_tag" => $idCreateur, ":nomPizza_tag" => $nom);
		// Exécuter la requête
		$recuperer_requete->execute($tags);
		// Définir le type d'affichage
		$recuperer_requete->setFetchMode(PDO::FETCH_CLASS, "PIZZA");
		// Récupérer le résultat renvoyé
		$tabPizzas = $recuperer_requete->fetchAll();
		// Si aucune valeur
		if (empty($tabPizzas)) {
			// Renvoyer null
			return null;
		}
		// Sélectionner l'identifiant du premier objet du tableau
		$idPizza = $tabPizzas[0]->idPizza;
		// Renvoyer l'identifiant
		return $idPizza;
	}

	/**
	 * Afficher les pizzas dans l'ordre alphabétique créer par le client
	 * @param int $id L'identifiant du client
	 * @return array $pizzas Le tableau de pizza
	 */
	public static function getPizzaPersoAlphabetique($id) {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PIZZA.idPizza, PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM PIZZA INNER JOIN compose_de ON PIZZA.idPizza = compose_de.RecettePizza INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient WHERE PIZZA.Createur = :id_tag GROUP BY PIZZA.idPizza, INGREDIENT.idIngredient HAVING MIN(INGREDIENT.QuantiteEnStockIngredient / compose_de.QuantiteDeIngredient) >= 1 ORDER BY PIZZA.NomPizza ASC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tag = array(":id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tag);
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PIZZA'); 
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(); 
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les pizzas dans l'ordre inverse alphabétiquecréer par le client
	 * @param int $id L'identifiant du client
	 * @return array $pizzas Le tableau de pizza
	 */
	public static function getPizzaInverseAlphabetiquePerso($id) {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PIZZA.idPizza, PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM PIZZA INNER JOIN compose_de ON PIZZA.idPizza = compose_de.RecettePizza INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient WHERE PIZZA.Createur = :id_tag  GROUP BY PIZZA.idPizza, INGREDIENT.idIngredient HAVING MIN(INGREDIENT.QuantiteEnStockIngredient / compose_de.QuantiteDeIngredient) >= 1 ORDER BY PIZZA.NomPizza DESC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tag = array(":id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tag);
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PIZZA'); 
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(); 
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les pizzas dans l'ordre croissant des prix créer par le client
	 * @param int $id L'identifiant du client
	 * @return array $pizzas Le tableau de pizza
	 */
	public static function getPizzaPrixCroissantPerso($id) {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PIZZA.idPizza, PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM PIZZA INNER JOIN compose_de ON PIZZA.idPizza = compose_de.RecettePizza INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient WHERE PIZZA.Createur = :id_tag  GROUP BY PIZZA.idPizza, INGREDIENT.idIngredient HAVING MIN(INGREDIENT.QuantiteEnStockIngredient / compose_de.QuantiteDeIngredient) >= 1 ORDER BY PIZZA.PrixPizza ASC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tag = array(":id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tag);
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PIZZA'); 
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(); 
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les pizzas dans l'ordre décroissant des prix créer par le client
	 * @param int $id L'identifiant du client
	 * @return array $pizzas Le tableau de pizza
	 */
	public static function getPizzaPrixDecroissantPerso($id) {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PIZZA.idPizza, PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM PIZZA INNER JOIN compose_de ON PIZZA.idPizza = compose_de.RecettePizza INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient WHERE PIZZA.Createur = :id_tag  GROUP BY PIZZA.idPizza, INGREDIENT.idIngredient HAVING MIN(INGREDIENT.QuantiteEnStockIngredient / compose_de.QuantiteDeIngredient) >= 1 ORDER BY PIZZA.PrixPizza DESC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tag = array(":id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tag);
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PIZZA'); 
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(); 
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}


	/**
	 * Créer une pizza par le gestionnaire.
	 * @param string $nom Le nom de la pizza.
	 * @param string $description La description de la pizza.
	 * @param string $theme Le thème de la pizza
	 * @param int $createur L'identifiant du créateur de la pizza.
	 */
	public static function creerPizzaGestionnaire($nom, $description, $theme, $createur){
		// Préparer la requête d'insertion
		$requeteInsertion = "INSERT INTO PIZZA (NomPizza, DescriptionPizza, Theme, AjoutGestionnaire) VALUES (:nomPizza_tag, :descriptionPizza_tag , :theme_tag, :idCreateur_tag );";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":nomPizza_tag" => $nom, ":descriptionPizza_tag" => $description, ":theme_tag" => $theme,":idCreateur_tag" => $createur);
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
	 * Renvoyer l'identifiant de la pizza.
	 * @param string $nom Le nom de la pizza.
	 * @param int $id L'identifiant du créateur.
	 * @return int $idPizza L'identifiant de la pizza
	 */
	public static function getNumeroPizzaGestionnaire($nom, $idCreateur) {
		// Préparer la requête
		$requetePreparee = "SELECT PIZZA.idPizza FROM PIZZA WHERE PIZZA.AjoutGestionnaire = :idCreateur_tag AND PIZZA.NomPizza = :nomPizza_tag;";
		// Récupérer la requête préparée
		$recuperer_requete = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tags = array(":idCreateur_tag" => $idCreateur, ":nomPizza_tag" => $nom);
		// Exécuter la requête
		$recuperer_requete->execute($tags);
		// Définir le type d'affichage
		$recuperer_requete->setFetchMode(PDO::FETCH_CLASS, "PIZZA");
		// Récupérer le résultat renvoyé
		$tabPizzas = $recuperer_requete->fetchAll();
		// Si aucune valeur
		if (empty($tabPizzas)) {
			// Renvoyer null
			return null;
		}
		// Sélectionner l'identifiant du premier objet du tableau
		$idPizza = $tabPizzas[0]->idPizza;
		// Renvoyer l'identifiant
		return $idPizza;
	}

	/**
	 * Supprimer une pizza par le gestionnaire.
	 * @param int $id L'identifiant de la pizza.
	 */
	public static function supprimerPizzaGestionnaire($id){
		// Préparer la requête d'insertion
		$requeteInsertion = "DELETE FROM PIZZA WHERE PIZZA.idPizza = :id_tag;";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":id_tag" => $id);
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