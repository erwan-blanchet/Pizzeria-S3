<?php
		// Faire le lien avec le fichier mère
		require_once("objet.php");

/**
 * Classe des produits. C'est une classe fille d'objet.
 * @author Estelle BOISSERIE
 * @author Erwan BLANCHET
 */
class PRODUIT extends objet{
	//------------------------
	// ATTRIBUTS
	//------------------------
	protected static string $identifiant = "idProduit";
	protected static string $classe = "PRODUIT";
	protected int $idProduit;
	protected string $NomProduit;
	protected ?string $DescriptionProduit;
	protected string $TypeProduit;
	protected int $PrixAchatProduit;
	protected string $DateAchatProduit;
	protected ?int $MargeProduit;
	protected ?int $PrixProduit;
	protected ?int $QuantiteEnStockProduit;
	protected ?string $PhotoIngredient;



	//------------------------
	// CONSTRUCTEUR
	//------------------------
	public function __construct(int $idProduit = NULL, string $NomProduit = NULL, string $DescriptionProduit = NULL, string $TypeProduit = NULL, int $PrixAchatProduit = NULL, string $DateAchatProduit = NULL, int $MargeProduit = NULL, int $PrixProduit = NULL, int $QuantiteEnStockProduit = NULL, string $PhotoIngredient = NULL){
		if(!is_null($idProduit)){
			$this->idProduit = $idProduit;
			$this->NomProduit = $NomProduit;
			$this->DescriptionProduit = $DescriptionProduit;
			$this->TypeProduit = $TypeProduit;
			$this->PrixAchatProduit = $PrixAchatProduit;
			$this->DateAchatProduit = $DateAchatProduit;
			$this->MargeProduit = $MargeProduit;
			$this->PrixProduit = $PrixProduit;
			$this->QuantiteEnStockProduit = $QuantiteEnStockProduit;
			$this->PhotoIngredient = $PhotoIngredient;
		}
	}



	//------------------------
	// METHODES
	//------------------------
	public function __toString(){
		if (is_null($this->idProduit)){
			$chaine = "Ce produit ne figure pas dans notre base de données.";
		}
		else if (is_null($this->DescriptionProduit)){
			if ($this->TypeProduit == "Boisson"){
				$chaine = "$this->NomProduit est une $this->TypeProduit que nous avons acheté à $this->PrixAchatProduit le $this->DateAchatProduit. Nous le vendons à $this->PrixProduit € car nous appliquons une marge $this->MargeProduit €. Il reste actuellement $this->QuantiteEnStockProduit $this->NomProduit en stock.";
			}
			else {
				$chaine = "$this->NomProduit est un $this->TypeProduit que nous avons acheté à $this->PrixAchatProduit le $this->DateAchatProduit. Nous le vendons à $this->PrixProduit € car nous appliquons une marge $this->MargeProduit €. Il reste actuellement $this->QuantiteEnStockProduit $this->NomProduit en stock.";
			}
		}
		else {
			if ($this->TypeProduit == "Boisson"){
				$chaine = "$this->NomProduit est une $this->TypeProduit que nous avons acheté à $this->PrixAchatProduit le $this->DateAchatProduit. $this->NomProduit est $this->DescriptionProduit. Nous le vendons à $this->PrixProduit € car nous appliquons une marge $this->MargeProduit €. Il reste actuellement $this->QuantiteEnStockProduit $this->NomProduit en stock.";
			}
			else {
				$chaine = "$this->NomProduit est un $this->TypeProduit que nous avons acheté à $this->PrixAchatProduit le $this->DateAchatProduit. $this->NomProduit est $this->DescriptionProduit. Nous le vendons à $this->PrixProduit € car nous appliquons une marge $this->MargeProduit €. Il reste actuellement $this->QuantiteEnStockProduit $this->NomProduit en stock.";
			}
		}
		return $chaine;
	}

	/**
	 * Afficher les boissons dans l'ordre alphabétique.
	 * @return array $boissons Le tableau de boisson.
	 */
	public static function getBoissonAlphabetique() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.DescriptionProduit, PRODUIT.PrixProduit, PRODUIT.PhotoProduit, PRODUIT.QuantiteEnStockProduit FROM PRODUIT WHERE PRODUIT.QuantiteEnStockProduit >= 1 AND PRODUIT.TypeProduit = 'Boisson' ORDER BY PRODUIT.NomProduit ASC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT'); 
			// Récupérer les boissons correspondantes
			$boissons = $resultat->fetchAll(); 
			// Retourner le résultat
			return $boissons;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les boissons dans l'ordre inverse alphabétique.
	 * @return array $boissons Le tableau de boisson.
	 */
	public static function getBoissonInverseAlphabetique() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.DescriptionProduit, PRODUIT.PrixProduit, PRODUIT.PhotoProduit, PRODUIT.QuantiteEnStockProduit  FROM PRODUIT WHERE PRODUIT.QuantiteEnStockProduit >= 1 AND PRODUIT.TypeProduit = 'Boisson' ORDER BY PRODUIT.NomProduit DESC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT'); 
			// Récupérer les boissons correspondantes
			$boissons = $resultat->fetchAll(); 
			// Retourner le résultat
			return $boissons;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les boissons dans l'ordre croissant des prix.
	 * @return array $boissons Le tableau de boisson.
	 */
	public static function getBoissonPrixCroissant() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.DescriptionProduit, PRODUIT.PrixProduit, PRODUIT.PhotoProduit, PRODUIT.QuantiteEnStockProduit  FROM PRODUIT WHERE PRODUIT.QuantiteEnStockProduit >= 1 AND PRODUIT.TypeProduit = 'Boisson' ORDER BY PRODUIT.PrixProduit ASC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT'); 
			// Récupérer les boissons correspondantes
			$boissons = $resultat->fetchAll(); 
			// Retourner le résultat
			return $boissons;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les boissons dans l'ordre décroissant des prix.
	 * @return array $boissons Le tableau de boisson.
	 */
	public static function getBoissonPrixDecroissant() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.DescriptionProduit, PRODUIT.PrixProduit, PRODUIT.PhotoProduit, PRODUIT.QuantiteEnStockProduit FROM PRODUIT WHERE PRODUIT.QuantiteEnStockProduit >= 1 AND PRODUIT.TypeProduit = 'Boisson' ORDER BY PRODUIT.QuantiteEnStockProduit DESC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT'); 
			// Récupérer les boissons correspondantes
			$boissons = $resultat->fetchAll(); 
			// Retourner le résultat
			return $boissons;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Afficher les desserts dans l'ordre alphabétique.
	 * @return array $desserts Le tableau de dessert.
	 */
	public static function getDessertAlphabetique() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.DescriptionProduit, PRODUIT.PrixProduit, PRODUIT.PhotoProduit, PRODUIT.QuantiteEnStockProduit FROM PRODUIT WHERE PRODUIT.QuantiteEnStockProduit >= 1 AND PRODUIT.TypeProduit = 'Dessert' ORDER BY PRODUIT.NomProduit ASC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT'); 
			// Récupérer les desserts correspondants
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
	 * Afficher les desserts dans l'ordre inverse alphabétique.
	 * @return array $desserts Le tableau de dessert.
	 */
	public static function getDessertInverseAlphabetique() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.DescriptionProduit, PRODUIT.PrixProduit, PRODUIT.PhotoProduit, PRODUIT.QuantiteEnStockProduit FROM PRODUIT WHERE PRODUIT.QuantiteEnStockProduit >= 1 AND PRODUIT.TypeProduit = 'Dessert' ORDER BY PRODUIT.NomProduit DESC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT'); 
			// Récupérer les desserts correspondants
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
	 * Afficher les desserts dans l'ordre croissant des prix.
	 * @return array $desserts Le tableau de dessert.
	 */
	public static function getDessertPrixCroissant() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.DescriptionProduit, PRODUIT.PrixProduit, PRODUIT.PhotoProduit, PRODUIT.QuantiteEnStockProduit FROM PRODUIT WHERE PRODUIT.QuantiteEnStockProduit >= 1 AND PRODUIT.TypeProduit = 'Dessert' ORDER BY PRODUIT.PrixProduit ASC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT'); 
			// Récupérer les desserts correspondants
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
	 * Afficher les desserts dans l'ordre décroissant des prix.
	 * @return array $desserts Le tableau de dessert.
	 */
	public static function getDessertPrixDecroissant() {
		// Préparer la requête
		$requetePreparee = "SELECT DISTINCT PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.DescriptionProduit, PRODUIT.PrixProduit, PRODUIT.PhotoProduit, PRODUIT.QuantiteEnStockProduit FROM PRODUIT WHERE PRODUIT.QuantiteEnStockProduit >= 1 AND PRODUIT.TypeProduit = 'Dessert' ORDER BY PRODUIT.QuantiteEnStockProduit DESC;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Définir le mode de récupération
			$resultat->setFetchMode(PDO::FETCH_CLASS, 'PRODUIT'); 
			// Récupérer les desserts correspondants
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
	 * Afficher les détails d'un produit
	 * @param int $id L'identifiant du produit
	 * @return array $infos Les infos du produit.
	 */
	public static function getDetailProduit($id) {
		// Préparer la requête
		$requetePreparee = "SELECT PRODUIT.idProduit, PRODUIT.NomProduit, PRODUIT.DateAchatProduit, PRODUIT.DescriptionProduit, PRODUIT.PrixAchatProduit, PRODUIT.PrixProduit, PRODUIT.PhotoProduit, PRODUIT.QuantiteEnStockProduit, FOURNISSEUR.NomFournisseur FROM PRODUIT INNER JOIN provient ON provient.ProduitRecherche = PRODUIT.idProduit INNER JOIN FOURNISSEUR ON FOURNISSEUR.idFournisseur = provient.FournisseurDuProduit WHERE PRODUIT.idProduit = :id_tag;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur du paramètre
		$tags = array(":id_tag" => $id);
		try {
			// Exécuter la requête
			$resultat->execute($tags);
			// Récupérer les détails du produit
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
	 * Créer une alerte
	 * @param string $nom Le nom de l'alerte
	 * @param int $quantiteMinimum La quantité minimum
	 * @param int $id L'identifiant du produit 
	 */
	public static function creerAlerteProduit($nom, $quantiteMinimum, $id){
		/// Préparer la requête d'insertion
		$requeteAlerte = "CREATE OR REPLACE TRIGGER {$nom} AFTER UPDATE ON PRODUIT FOR EACH ROW BEGIN DECLARE alertMessage VARCHAR(255); IF (NEW.idProduit = :id_tag AND NEW.QuantiteEnStockProduit<= :nb_tag) THEN SET alertMessage = CONCAT(NEW.NomProduit, ' nécessite un réapprovisionnement'); SIGNAL SQLSTATE '25007' SET MESSAGE_TEXT = alertMessage; END IF; END;//";      
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
	 * Afficher les alertes sur produit
	 */
	public static function afficherAlerteProduit(){
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
	 * Supprimer un produit par le gestionnaire.
	 * @param int $id L'identifiant du produit.
	 */
	public static function supprimerProduitGestionnaire($id){
		// Préparer la requête d'insertion
		$requeteInsertion = "DELETE FROM PRODUIT WHERE PRODUIT.idProduit = :id_tag;";      
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