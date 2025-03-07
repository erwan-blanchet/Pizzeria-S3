<?php   
		// Lien avec le fichier mère 
		require_once("controlleurObjet.php");
// Lien avec le modèle
require_once("Modele/pizza.php");


/**
 * Classe controlleur de PIZZA. C'est une classe fille de controlleurObjet.
 * @author Estelle BOISSERIE
 */
class controlleurPizza extends controlleurObjet {
	//---------------------
	// ATTRIBUTS
	//---------------------
	protected static string $classe="PIZZA";
	protected static string $identifiant = "idPizza";



	//---------------------
	// METHODES
	//---------------------
	/**
	 * Afficher les pizzas selon la saison actuelle.
	 * @return array $pizzas Le tableau de pizzas correspondant.
	 */
	public static function pizzaTheme(){
		// Obtenir la date actuelle
		$dateActuelle = new DateTime();
		// Obtenir le mois actuel
		$moisActuel = $dateActuelle->format('n');
		// Si le mois est entre mars et juin, nous sommes au printemps
		if ($moisActuel >= 2 && $moisActuel <= 5) {
			$saison = 'Printemps';
		} 
		// Si nous sommes entre juin et août nous sommes en été
		elseif ($moisActuel >= 6 && $moisActuel <= 8) {
			$saison = 'Été';
		} 
		// Si nous sommes entre septembre et octobre, nous sommes en automne
		elseif ($moisActuel >= 9 && $moisActuel <= 10) {
			$saison = 'Automne';
		} 
		// Si nous sommes entre novembre et janvier, nous sommes en hivers
		else {
			$saison = 'Hiver';
		}
		// Récupérer les pizzas qui correspondent à la saison sous forme de tableau
		$pizzas = self::$classe::getPizzaALaUne($saison);
		// Retourner le tableau
		return $pizzas;
	}

	/**
	 * Créer une pizza personnalisé
	 */
	public static function creerPizzaPerso(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validerChangements'])) {
			// Récupérer l'identifiant du client depuis la session
			$idClient = $_SESSION['idClient'];
			// Récupérer le nom de la nouvelle pizza
			$nomNouvellePizza = $_POST['nomPizza'];

			// Récupérer la description de la nouvelle pizza
			$descriptionNouvellePizza = $_POST['descriptionPizza'];

			// Appeler les fichiers
			require_once("./Modele/pizza.php");
			require_once("./Modele/compose_de.php");

			// Créer la pizza
			pizza::creerPizzaPerso($nomNouvellePizza, $descriptionNouvellePizza, $idClient);
			// Récupérer l'identifiant de la pizza créée
			$idPizzaCree = pizza::getNumeroPizza($nomNouvellePizza, $idClient);

			// Pour chaque ingrédient dans la pizza
			foreach ($_POST as $key => $value) {
				if (strpos($key, 'quantite_') !== false) {
					$ingredientID = str_replace('quantite_', '', $key);
					$quantiteIngredient = $_POST['quantite_' . $ingredientID];
					// Ajouter l'ingrédient à la pizza
					compose_de::creerUneComposition($idPizzaCree, $ingredientID, $quantiteIngredient);
				}
			}

			// Récupérer le numéro de commande depuis la session
			$numeroCommande = $_SESSION['numeroCommande'];
			// Appeler le fichier
			require_once("./Modele/commande_pizza.php");
			// Ajouter la pizza à la commande
			commande_pizza::commanderPizza($idPizzaCree, $numeroCommande);
			// Afficher une nouvelle page 
			controlleurObjet::validerPersonnalisation();
		}
	}

	/**
	 * Modifier la quantité d'une pizza.
	 */
	public static function modifierQuantite(){
		// Récupérer l'ID de la pizza depuis l'URL
		$idPizza = $_GET['idPizza'];
		// Récupérer le numéro de commande depuis la session
		$numeroCommande = $_SESSION['numeroCommande'];

		// Vérifier si le formulaire a été soumis
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nouvelleQuantitePizza'])) {
			// Récupérer la nouvelle quantité saisie
			$nouvelleQuantite = $_POST['nouvelleQuantitePizza'];

			// Appeler le fichier
			require_once("./Modele/commande_pizza.php");

			// Ajuster la quantité de pizza de la commande
			commande_pizza::ajusterQuantitePizza($nouvelleQuantite, $idPizza, $numeroCommande);

			// Afficher une nouvelle page
			controlleurObjet::panier();
		}
	}

	/**
	 * Créer une pizza par un gestionnaire
	 */
	public static function creerPizzaGestionnaire(){
		// Récupérer l'identifiant du gestionnaire depuis la session
		$idGestionnaire = $_SESSION['idGestionnaire'];

		// Inclure les modèles nécessaires
		require_once("./Modele/pizza.php");
		require_once("./Modele/ingredient.php");
		require_once("./Modele/compose_de.php");

		// Vérifier si le formulaire a été soumis ainsi qu'une image
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validerCreationPizza']) && isset($_FILES['imageCreation'])) {
			// Récupérer les données du formulaire
			$nomPizza = $_POST['nomCreation'];
			$descriptionPizza = $_POST['descriptionCreation'];
			$themePizza = $_POST['themeCreation'];

			// Définir le début du chemin
			$dossierImages = realpath("./Images/Pizzas") . "/"; 
			// Vérifier si le fichier est une image PNG
			$extensionsAutorisees = ['png'];
			$extensionFichier = strtolower(pathinfo($_FILES['imageCreation']['name'], PATHINFO_EXTENSION));
			// Si l'extension correspond à png
			if (in_array($extensionFichier, $extensionsAutorisees)) {
				// Télécharger la photo et la mettre dans le dossier approprié
				move_uploaded_file($_FILES['imageCreation']['tmp_name'], $dossierImages . $_FILES['imageCreation']['name']);

			} 
			else {
				echo "Erreur : Seules les images au format PNG sont autorisées.";
			}

			// Créer la pizza
			pizza::creerPizzaGestionnaire($nomPizza, $descriptionPizza, $themePizza, $idGestionnaire);
			// Récupérer son identifiant
			$idPizza = pizza::getNumeroPizzaGestionnaire($nomPizza, $idGestionnaire);

			// Récupérer les ingrédients
			$ingredients = ingredient::getIngredients();

			// Pour chaque ingrédient
			foreach ($ingredients as $ingredient) {
				// Récupérer la quantité saisit par l'utilisateur
				$quantite = $_POST["nouvelleQuantiteCreation_{$ingredient['idIngredient']}"];

				// Si la quantité est supérieure à 0
				if ($quantite > 0) {
					// Créer une composition
					compose_de::creerUneComposition($idPizza, $ingredient['idIngredient'], $quantite);
				}
			}
			//Afficher une nouvelle page
			controlleurObjet::recettesGestionnaire();
		}
	}

	/**
	 * Supprimer une pizza d'une commande.
	 */
	public static function supprimerCommandeDePizza(){
		// Récupérer l'ID de la pizza depuis l'URL
		$idPizza = $_GET['idPizza'];
		// Récupérer le numéro de commande depuis la session
		$numeroCommande = $_SESSION['numeroCommande'];

		// Inclure les modèles nécessaires
		require_once("./Modele/commande_pizza.php");

        // Supprimer une pizza commandé
		commande_pizza::supprimerPizzaCommande($idPizza, $numeroCommande);

        // Afficher une nouvelle page
		controlleurObjet::panier();
	}
}
?>