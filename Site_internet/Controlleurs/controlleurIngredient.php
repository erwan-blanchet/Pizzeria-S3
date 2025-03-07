<?php   
		// Lien avec le fichier mère 
		require_once("controlleurObjet.php");
// Lien avec le modèle
require_once("Modele/ingredient.php");


/**
 * Classe controlleur de INGREDIENT. C'est une classe fille de controlleurObjet.
 * @author Estelle BOISSERIE
 */
class controlleurIngredient extends controlleurObjet {
	//---------------------
	// ATTRIBUTS
	//---------------------
	protected static string $classe="INGREDIENT";
	protected static string $identifiant = "idIngredient";



	//---------------------
	// METHODE
	//---------------------
	/**
	 * Créer une alerte
	 */
	public static function creerAlerte(){
		/// Vérifier si le formulaire a été soumis
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["valider"])) {
			// Récupérer l'identifiant de l'ingrédient
			$idIngredient = $_GET['idIngredient'];
			// Récupérer les données saisies
			$nom = $_POST["nom"];
			$quantiteMinimum = $_POST["quantiteMinimum"];
			// Appeler les fichiers
			require_once("./Modele/ingredient.php");
			// Créer l'alerte
			ingredient::creerAlerteIngredient($nom, $quantiteMinimum, $idIngredient);
			// Afficher les vues
			controlleurObjet::alerteConfirmer();
		}
	}
}
?>