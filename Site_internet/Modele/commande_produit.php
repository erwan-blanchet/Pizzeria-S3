<?php
		// Faire le lien avec le fichier mère
		require_once("objet.php");

/**
 * Classe qui fait le lien entre les commandes et les produit commandés. C'est une classe fille d'objet.
 * @author Estelle BOISSERIE
 */
class commande_produit extends objet{
	//------------------------
	// ATTRIBUTS
	//------------------------
	protected int $ProduitCommande;
	protected int $CommandeFait;
	protected int $QuantiteProduit;



	//------------------------
	// CONSTRUCTEUR
	//------------------------
	public function __construct(int $ProduitCommande = NULL, int $CommandeFait = NULL, int $QuantiteProduit = NULL, String $CommentairePizza = NULL, String $StatusPizza = NULL){
		if (!is_null($ProduitCommande) && !is_null($CommandeFait)) {
			$this->ProduitCommande = $ProduitCommande;
			$this->CommandeFait = $CommandeFait;
			$this->QuantiteProduit = $QuantiteProduit;
		}
	}



	//------------------------
	// METHODES
	//------------------------
	/**
	 * Commander un produit.
	 * @param int $id L'identifiant du produit.
	 * @param int $numeroCommande Le numéro de commande.
	 */
	public static function commanderProduit($id, $numeroCommande){
		// Préparer la requête d'insertion
		$requeteInsertion = "INSERT INTO commande_produit (ProduitCommande, CommandeFait, QuantiteProduit) VALUES (:id_tag, :num_tag, 1);";
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":id_tag" => $id, ":num_tag" => $numeroCommande);
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
	 * Ajuster la quantite de la commande produit.
   * @param int $quantite La quantité de produit.
   * @param int $produit L'identifiant du produit.
   * @param int $commande Le numéro de la commande.
	 */
	public static function ajusterQuantiteProduit($quantite, $produit, $commande){
		// Préparer la requête d'insertion
		$requeteInsertion = "UPDATE commande_produit SET commande_produit.QuantiteProduit = :qtt_tag WHERE commande_produit.ProduitCommande = :id_tag AND commande_produit.CommandeFait = :num_tag;";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":id_tag" => $produit, ":num_tag" => $commande, ":qtt_tag" => $quantite);
		try {
			// Exécuter la requête
			$insertion->execute($tags);
		} catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
			// Capturer l'erreur
			$erreur_du_trigger = $e->getMessage();
			// Stocker l'erreur dans une variable de session
			$_SESSION['alerte_trigger'] = $erreur_du_trigger;
		}
	}

	/**
	 * Supprimer un produit d'une commande.
   * @param int $produit L'identifiant du produit.
   * @param int $commande Le numéro de la commande.
	 */
	public static function supprimerProduitCommande($produit, $commande){
		// Préparer la requête d'insertion
		$requeteInsertion = "DELETE FROM commande_produit WHERE commande_produit.ProduitCommande = :id_tag AND commande_produit.CommandeFait = :num_tag;";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":id_tag" => $produit, ":num_tag" => $commande);
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


