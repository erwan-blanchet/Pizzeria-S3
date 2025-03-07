<?php
		// Faire le lien avec le fichier mère
		require_once("objet.php");

/**
 * Classe des statistiques. C'est une classe fille d'objet.
 * @author Estelle BOISSERIE
 */
class COMMANDE extends objet{
	//------------------------
	// ATTRIBUTS
	//------------------------
	protected static string $identifiant = "numCommande";
	protected static string $classe = "COMMANDE";
	protected int $numCommande;
	protected DATE $DateCommande;
	protected string $StatutCommande;
	protected ?int $DelaisLivraison;
	protected ?int $TVA;
	protected ?int $MargeCommande;
	protected ?int $TotalCommande;
	protected ?int $TotalPrixPizza;
	protected ?int $TotalPrixProduit;
	protected ?int $PaiementCommande;
	protected int $ClientCommande;



	//------------------------
	// CONSTRUCTEUR
	//------------------------
	public function __construct(int $numCommande = NULL, DATE $DateCommande = NULL,  string $StatutCommande   = NULL, int $DelaisLivraison = NULL, int $TVA = NULL, int $MargeCommande = NULL, int $TotalCommande = NULL, int $TotalPrixPizza = NULL, int $TotalPrixProduit = NULL, int $PaiementCommande = NULL, int $ClientCommande = NULL){
		if(!is_null($numCommande)){
			$this->numCommande = $numCommande;
			$this->DateCommande = $DateCommande;
			$this->DelaisLivraison = $DelaisLivraison;
			$this->TVA = $TVA;
			$this->MargeCommande = $MargeCommande;
			$this->TotalCommande = $TotalCommande;
			$this->TotalPrixPizza = $TotalPrixPizza;
			$this->TotalPrixProduit = $TotalPrixProduit;
			$this->PaiementCommande = $PaiementCommande;
			$this->ClientCommande = $ClientCommande;
		}
	}



	//------------------------
	// METHODES
	//------------------------
	public function __toString(){
		if (is_null($this->numCommande)){
			$chaine = "Cette commande ne figure pas dans notre base de données.";
		}
		else {
			$chaine = "La date de commande est :  $this->DateCommande  avec le statut :  $this->StatutCommande";
		}
		return $chaine;
	}

	/**
	 * Récupérer le numéro de la commande.
	 * @param int $id L'identifiant du client.
	 * @return int $numero Le numéro de la commande.
	 */
	public static function getNumeroCommande($id) {
		// Préparer la requête
		$requetePreparee = "SELECT COMMANDE.numCommande FROM COMMANDE WHERE COMMANDE.ClientCommande = :id_tag AND COMMANDE.StatutCommande = 'En cours';";
		// Récupérer la requête préparée
		$recuperer_requete = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tag = array(":id_tag" => $id);
		// Exécuter la requête
		$recuperer_requete->execute($tag);
		// Récupérer le résultat renvoyé
		$numeroCommande = $recuperer_requete->fetchColumn();
		// Renvoyer l'identifiant
		return $numeroCommande;
	}

	/**
	 * Récupérer le numéro de la commande.
	 * @param int $id L'identifiant du client.
	 * @return int $quantite La quantite d'article commande.
	 */
	public static function getQuantiteCommande($id) {
		// Préparer la requête
		$requetePreparee = "SELECT (SELECT COALESCE(SUM(QuantiteProduit), 0) FROM commande_produit WHERE CommandeFait = COMMANDE.numCommande) + (SELECT COALESCE(SUM(QuantitePizza), 0) FROM commande_pizza WHERE CommandeEffectue = COMMANDE.numCommande) AS quantiteCommande FROM COMMANDE WHERE COMMANDE.numCommande = :id_tag;";
		// Récupérer la requête préparée
		$recuperer_requete = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tag = array(":id_tag" => $id);
		// Exécuter la requête
		$recuperer_requete->execute($tag);
		// Récupérer le résultat renvoyé 
		$resultat = $recuperer_requete->fetch(PDO::FETCH_ASSOC);
		// Si aucune valeur
		if (empty($resultat)) {
			// Renvoyer null
			return null;
		}
		// Renvoyer la quantité comme un entier
		return (int)$resultat['quantiteCommande'];
	}

	/**
	 * Récupérer les informations des produits commandés.
	 * @param int $num Le numéro de commande.
	 * @return array $produits Les informations sur les produits commandés.
	 */
	public static function getProduitPanier($id) {
		// Préparer la requête
		$requetePreparee = "SELECT COMMANDE.numCommande, commande_produit.QuantiteProduit, PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.PhotoProduit, PRODUIT.PrixProduit FROM COMMANDE LEFT JOIN commande_produit ON COMMANDE.numCommande = commande_produit.CommandeFait LEFT JOIN PRODUIT ON commande_produit.ProduitCommande = PRODUIT.idProduit WHERE COMMANDE.numCommande = :id_tag;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur du paramètre
		$tag = array(":id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tag);
			// Récupérer les produits correspondants
			$produits = $resultat->fetchAll(PDO::FETCH_ASSOC);
			// Retourner le résultat
			return $produits;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * Récupérer les informations des pizzas commandées.
	 * @param int $num Le numéro de commande.
	 * @return array $pizzas Les informations sur les pizzas commandées.
	 */
	public static function getPizzaPanier($id) {
		// Préparer la requête
		$requetePreparee = "SELECT COMMANDE.numCommande, commande_pizza.QuantitePizza, commande_pizza.CommentairePizza, PIZZA.idPizza, PIZZA.NomPizza, PIZZA.PrixPizza, PIZZA.PhotoPizza FROM COMMANDE LEFT JOIN commande_pizza ON COMMANDE.numCommande = commande_pizza.CommandeEffectue LEFT JOIN PIZZA ON commande_pizza.PizzaCommande = PIZZA.idPizza WHERE COMMANDE.numCommande = :id_tag;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur du paramètre
		$tag = array(":id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tag);
			// Récupérer les pizzas correspondantes
			$pizzas = $resultat->fetchAll(PDO::FETCH_ASSOC);
			// Retourner le résultat
			return $pizzas;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * Récupérer les informations de la commande.
	 * @param int $num Le numéro de commande.
	 * @return array $infos Les informations de la commande.
	 */
	public static function getPanier($id) {
		// Préparer la requête
		$requetePreparee = "SELECT COMMANDE.numCommande, COMMANDE.TotalCommande FROM COMMANDE WHERE COMMANDE.numCommande = :id_tag;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur du paramètre
		$tag = array(":id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tag);
			// Récupérer les informations correspondantes
			$infos = $resultat->fetch(PDO::FETCH_ASSOC);
			// Retourner le résultat
			return $infos;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Vérifier le status de la commande avant la déconnexion.
	 * @param int $id L'identifiant de la commande.
	 */
	public static function verifierCommande($id) {
		try {
			// Vérifier le statut de la commande
			$requetePrepareeCommande = "SELECT StatutCommande FROM COMMANDE WHERE numCommande = :id_tag";
			$requeteStatut = connexion::pdo()->prepare($requetePrepareeCommande);
			$tag = array(":id_tag" => $id);
			$requeteStatut->execute($tag);
			$resultatStatut = $requeteStatut->fetch(PDO::FETCH_ASSOC);
			// Si le statut est "En cours", supprimer la commande et ses détails
			if ($resultatStatut['StatutCommande'] == 'En cours') {
				// Vérifier s'il y a des commandes de produits
				$requetePrepareeProduit = "SELECT DISTINCT numCommande FROM COMMANDE INNER JOIN commande_produit ON commande_produit.CommandeFait = COMMANDE.numCommande WHERE COMMANDE.numCommande = :id_tag";
				$requeteProduits = connexion::pdo()->prepare($requetePrepareeProduit);
				$tag2 = array(":id_tag" => $id);
				$requeteProduits->execute($tag2);
				// Si il y a des commandes de produits, supprimer d'abord les détails des produits
				if ($requeteProduits->rowCount() > 0) {
					$requetePrepareeSupprimerProduit = "DELETE FROM commande_produit WHERE CommandeFait = :id_tag";
					$requeteSupprimerProduits = connexion::pdo()->prepare($requetePrepareeSupprimerProduit);
					$tag3 = array(":id_tag" => $id);
					$requeteSupprimerProduits->execute($tag3);
				}
				// Vérifier si il y a des commandes de pizzas
				$requetePrepareePizza = "SELECT DISTINCT numCommande FROM COMMANDE INNER JOIN commande_pizza ON commande_pizza.CommandeEffectue = COMMANDE.numCommande WHERE COMMANDE.numCommande = :id_tag";
				$requetePizzas = connexion::pdo()->prepare($requetePrepareePizza);
				$tag4 = array(":id_tag" => $id);
				$requetePizzas->execute($tag4);
				// Si il y a des commandes de pizzas, supprimer d'abord les détails des pizzas
				if ($requetePizzas->rowCount() > 0) {
					$requetePrepareeSupprimerPizza = "DELETE FROM commande_pizza WHERE CommandeEffectue = :id_tag";
					$requeteSupprimerPizzas = connexion::pdo()->prepare($requetePrepareeSupprimerPizza);
					$tag5 = array(":id_tag" => $id);
					$requeteSupprimerPizzas->execute($tag5);
				}
				// Supprimer la commande principale
				$requetePrepareeSupprimerCommande = "DELETE FROM COMMANDE WHERE numCommande = :id_tag";
				$requeteSupprimerCommande = connexion::pdo()->prepare($requetePrepareeSupprimerCommande);
				$tag6 = array(":id_tag" => $id);
				$requeteSupprimerCommande->execute($tag6);
			} 
		} catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Modifier la commande après un paiement.
	 * @param int $num Le numéro de commande.
	 * @param int $id L'identifiant du paiement.
	 */
	public static function modifCommandePayee($num, $id){
		// Préparer la requête d'insertion
		$requeteInsertion = "UPDATE COMMANDE SET COMMANDE.StatutCommande = 'Validée', COMMANDE.PaiementCommande = :id_tag WHERE COMMANDE.numCommande = :num_tag;";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":id_tag" => $id, ":num_tag" => $num);
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
	 * Récupérer les commandes d'un client.
	 * @param int $id L'identifiant du client
	 * @return array $infos Les informations de la commande.
	 */
	public static function getMesCommandes($id) {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT COMMANDE.numCommande, COMMANDE.DateCommande, COMMANDE.StatutCommande, COMMANDE.TotalCommande FROM COMMANDE WHERE COMMANDE.ClientCommande = :id_tag ORDER BY COMMANDE.DateCommande DESC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur du paramètre
		$tag = array(":id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tag);
			// Récupérer les informations correspondantes
			$infos = $resultat->fetchAll(PDO::FETCH_ASSOC);
			// Retourner le résultat
			return $infos;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * Annuler une commande.
	 * @param int $num Le numéro de commande.
	 */
	public static function annulerCommande($num){
		// Préparer la requête d'insertion
		$requeteInsertion = "UPDATE COMMANDE SET COMMANDE.StatutCommande = 'Annulée' WHERE COMMANDE.numCommande = :num_tag;";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tag = array(":num_tag" => $num);
		try {
			// Exécuter la requête
			$insertion->execute($tag);
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Modifier le status de la commande après livraison.
	 * @param int $num Le numéro de commande.
	 */
	public static function livrerCommande($num){
		// Préparer la requête d'insertion
		$requeteInsertion = "UPDATE COMMANDE SET COMMANDE.StatutCommande = 'Livrée' WHERE COMMANDE.numCommande = :num_tag;";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tag = array(":num_tag" => $num);
		try {
			// Exécuter la requête
			$insertion->execute($tag);
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}
}
?>