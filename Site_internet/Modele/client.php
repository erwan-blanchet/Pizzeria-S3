<?php
		// Faire le lien avec le fichier mère
		require_once("objet.php");

/**
 * Classe des clients. C'est une classe fille d'objet.
 * @author Estelle BOISSERIE
 */
class CLIENT extends objet{
	//------------------------
	// ATTRIBUTS
	//------------------------
	protected static string $identifiant = "idClient";
	protected static string $classe = "CLIENT";
	protected int $idClient;
	protected int $IndividuClient;



	//------------------------
	// CONSTRUCTEUR
	//------------------------
	public function __construct(int $idClient = NULL, int $IndividuClient = NULL){
		if(!is_null($idClient)){
			$this->idClient = $idClient;
			$this->IndividuClient = $IndividuClient;
		}
	}



	//------------------------
	// METHODES
	//------------------------
	public function __toString(){
		if (is_null($this->idClient)){
			$chaine = "Ce client ne figure pas dans notre base de données.";
		}
		$chaine = "Le client ".$this->IndividuClient." s'appelle ".$this->nom;
		return $chaine;
	}

	/**
	 * Vérifier si l'individu est un client.
	 * @param string $mail L'adresse mail.
	 * @param string $mdp Le mot de passe.
	 * @return boolean True si c'est un client. False si ce n'est pas un client.
	 */
	public static function estClient($mail, $mdp) {
		// Récupérer le numIndividu
		$id = individu::getNumeroIndividu($mail, $mdp);
		// Préparer la requête
		$requetePreparee = "SELECT IndividuClient FROM CLIENT WHERE IndividuClient = :id_tag;";
		// Récupérer la requête préparer
		$recuperer_requete = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tag = array("id_tag" => $id);
		// Executer la réquête
		$recuperer_requete->execute($tag);
		// Définir le type d'affichage
		$recuperer_requete->setFetchMode(PDO::FETCH_CLASS,"CLIENT");
		// Récupérer le résultat renvoyer 
		$tabClients= $recuperer_requete->fetchAll();
		// Si aucune valeur
		if(empty($tabClients)){
			// Renvoyer null
			return False;
		}
		// Renvoyer l'identifiant
		return True;
	}

	/**
	 * Renvoyer le numéro de client.
	 * @param string $mail L'adresse mail de l'individu.
	 * @param string $mdp Le mot de passe de l'individu.
	 * @return int $idClientL'identifiant du client.
	 */
	public static function getNumeroClient($mail, $mdp) {
		// Récupérer le numIndividu
		$id = individu::getNumeroIndividu($mail, $mdp);
		// Préparer la requête
		$requetePreparee = "SELECT CLIENT.idClient FROM CLIENT WHERE IndividuClient = :id_tag;";
		// Récupérer la requête préparer
		$recuperer_requete = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tag = array("id_tag" => $id);
		// Executer la réquête
		$recuperer_requete->execute($tag);
		// Définir le type d'affichage
		$recuperer_requete->setFetchMode(PDO::FETCH_CLASS,"CLIENT");
		// Récupérer le résultat renvoyer 
		$tabClients= $recuperer_requete->fetchAll();
		// Sélectionner l'identifiant du premier objet du tableau
		$idClient = $tabClients[0]->idClient;
		// Si aucune valeur
		if(empty($tabClients)){
			// Renvoyer null
			return null;
		}
		// Renvoyer l'identifiant
		return $idClient;
	}

	/**
	 * Créer un client.
	 * @param int $idIndividu L'identifiant de l'individu client.
	 * @param int $idAdresse L'identifiant de l'adresse du client.
	 */
	public static function creerClient($idIndividu, $idAdresse){
		// Préparer la requête d'insertion
		$requeteInsertion = "INSERT INTO CLIENT (IndividuClient, AdresseClient) VALUES (:idIndividu_tag, :idAdresse_tag);";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":idIndividu_tag" => $idIndividu, ":idAdresse_tag" => $idAdresse);
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
	 * Savoir si le client est déjà présent dans la base de données.
	 * @param int $idIndividu L'identifiant de l'individu client.
	 * @param int $idAdresse L'identifiant de l'adresse du client.
	 * @return boolean $clientExiste True si le client est déjà présent, false sinon.
	 */
	public static function clientExiste($idIndividu, $idAdresse) {
		// Préparer la requête
		$requetePreparee = "SELECT CLIENT.idClient FROM CLIENT WHERE IndividuClient = :idIndividu_tag and AdresseClient = :idAdresse_tag;";
		// Récupérer la requête préparer
		$recuperer_requete = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tags = array( ":idIndividu_tag" => $idIndividu, ":idAdresse_tag" => $idAdresse);
		// Exécuter la requête
		$recuperer_requete->execute($tags);
		// Récupérer le résultat renvoyé 
		$nombreLignes = $recuperer_requete->fetchColumn();
		// Si la requête renvoie plus d'une ligne
		if ($nombreLignes > 0) {
			// Alors l'individu lle existe
			$clientExiste = true;
		} else {
			// Si non, l'individu n'existe pas
			$clientExiste = false;
		}
		// Renvoyer le boolean
		return $clientExiste;
	}
}
?>