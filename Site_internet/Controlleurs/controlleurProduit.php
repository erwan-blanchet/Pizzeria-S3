<?php   
		// Lien avec le fichier mère 
		require_once("controlleurObjet.php");
// Lien avec le modèle
require_once("Modele/produit.php");


/**
 * Classe controlleur de PRODUIT. C'est une classe fille de controlleurObjet.
 * @author Estelle BOISSERIE
 */
class controlleurProduit extends controlleurObjet {
	//---------------------
	// ATTRIBUTS
	//---------------------
	protected static string $classe="PRODUIT";
	protected static string $identifiant = "idProduit";




	//---------------------
	// METHODES
	//---------------------
	/**
	 * Avoir la liste des boissons.
	 * @return array $boissons Le tableau de boissons.
	 */
	public static function getBoissonsALaUne() {
		// Préparer la requête
		$requetePreparee = "SELECT * FROM PRODUIT WHERE TypeProduit = 'Boisson';";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT');
			// Récupérer les boissons
			$boissons= $resultat->fetchAll(); 
			// Retourner le résultat
			return $boissons;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Avoir la liste des desserts.
	 * @return array $desserts Le tableau de dessert.
	 */
	public static function getDessertsALaUne() {
		// Préparer la requête
		$requetePreparee = "SELECT * FROM PRODUIT WHERE TypeProduit = 'Dessert';";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT'); 
			// Récupérer les desserts 
			$desserts = $resultat->fetchAll(); 
			// Retourner le résultat
			return $desserts;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Créer une alerte.
	 */
	public static function creerAlerte(){
		/// Vérifier si le formulaire a été soumis
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["valider"])) {
			// Récupérer l'identifiant du produit
			$idProduit = $_GET['idProduit'];
			// Récupérer les données saisies
			$nom = $_POST["nom"];
			$quantiteMinimum = $_POST["quantiteMinimum"];

			// Appeler les fichiers
			require_once("./Modele/produit.php");

			// Créer l'alerte
			produit::creerAlerteProduit($nom, $quantiteMinimum, $idProduit);

			// Afficher une nouvelle page
			controlleurObjet::alerteConfirmer();
		}
	}

	/**
	 * Modifier la quantité d'un produit.
	 */
	public static function modifierQuantite(){
		// Récupérer l'ID de la produit depuis l'URL
		$idProduit = $_GET['idProduit'];
		// Récupérer le numéro de commande depuis la session
		$numeroCommande = $_SESSION['numeroCommande'];

		// Vérifier si le formulaire a été soumis
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nouvelleQuantiteProduit'])) {
			// Récupérer la nouvelle quantité saisie
			$nouvelleQuantite = $_POST['nouvelleQuantiteProduit'];

			// Appeler les fichiers
			require_once("./Modele/commande_produit.php");

      // Ajuster la quantité d'un produit dans une commande
			commande_produit::ajusterQuantiteProduit($nouvelleQuantite, $idProduit, $numeroCommande);

      // Afficher une nouvelle page
			controlleurObjet::panier();
		}
	}

	/**
	 * Supprimer un produit d'une commande.
	 */
	public static function supprimerCommandeDeProduit(){
		// Récupérer l'ID du produit depuis l'URL
		$idProduit = $_GET['idProduit'];

		// Récupérer le numéro de commande depuis la session
		$numeroCommande = $_SESSION['numeroCommande'];

		// Inclure les modèles nécessaires
		require_once("./Modele/commande_produit.php");

    // Supprimer un produit d'une commande
		commande_produit::supprimerProduitCommande($idProduit, $numeroCommande);

    // Afficher une nouvelle page
		controlleurObjet::panier();
	}

	/**
	 * Créer un ingrédient par un gestionnaire
	 */
	public static function creerIngredientGestionnaire(){
		// Récupérer l'identifiant du gestionnaire depuis la session
		$idGestionnaire = $_SESSION['idGestionnaire'];

		// Inclure les modèles nécessaires
		require_once("./Modele/ingredient.php");

		// Vérifier si le formulaire a été soumis ainsi qu'une image
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validerCreationIngredient']) && isset($_FILES['imageCreationIngredient'])) {
			// Récupérer les données du formulaire
			$nomCreationIngredient = $_POST['nomCreationIngredient'];
			$prixAchat = $_POST['prixAchat'];

			// Définir le début du chemin
			$dossierImages = realpath("./Images/Ingredidents") . "/"; 
			// Vérifier si le fichier est une image PNG
			$extensionsAutorisees = ['png'];
			$extensionFichier = strtolower(pathinfo($_FILES['imageCreationIngredient']['name'], PATHINFO_EXTENSION));
			// Si l'extension correspond à png
			if (in_array($extensionFichier, $extensionsAutorisees)) {
				// Télécharger la photo et la mettre dans le dossier approprié
				move_uploaded_file($_FILES['imageCreationIngredient']['tmp_name'], $dossierImages . $_FILES['imageCreationIngredient']['name']);

			} 
			else {
				echo "Erreur : Seules les images au format PNG sont autorisées.";
			}

			// Créer l'ingrédient
			ingredient::creerIngredientGestionnaire($nomCreationIngredient, $prixAchat);

			//Afficher une nouvelle page
			controlleurObjet::recettesGestionnaire();
		}
	}
}
?>