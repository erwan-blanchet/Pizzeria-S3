<?php
		// Faire le lien avec le fichier mère
		require_once("objet.php");

/**
 * Classe des adresses. C'est une classe fille d'objet.
 * @author Estelle BOISSERIE
 */
class ADRESSE extends objet{
	//------------------------
	// ATTRIBUTS
	//------------------------
	protected static string $identifiant = "idAdresse";
	protected static string $classe = "ADRESSE";
	protected int $idAdresse;
	protected int $Numero;
	protected ?string $SuffixeAdresse;
	protected string $NomRue;
	protected ?string $ComplementAdresse;
	protected int $VilleAdresse;



	//------------------------
	// CONSTRUCTEUR
	//------------------------
	public function __construct(int $idAdresse = NULL, int $Numero = NULL, string $SuffixeAdresse = NULL, string $NomRue = NULL, string $ComplementAdresse = NULL, int $VilleAdresse = NULL){
		if(!is_null($idAdresse)){
			$this->idAdresse = $idAdresse;
			$this->Numero = $Numero;
			$this->SuffixeAdresse = $SuffixeAdresse;
			$this->NomRue = $NomRue;
			$this->ComplementAdresse = $ComplementAdresse;
			$this->VilleAdresse = $VilleAdresse;
		}
	}



	//------------------------
	// METHODE
	//------------------------
	public function __toString(){
		// chaine contenant le numero, le nom de rue, complement d'adresse et le suffixe de l'adresse
		$chaine = "$this->Numero, $this->NomRue, $this->ComplementAdresse, $this->SuffixeAdresse,";
		if (is_null($this->idAdresse)){
			$chaine = "Cette adresse ne figure pas dans notre base de données.";
		}
		return $chaine;
	}

	/**
	 * Créer une adresse.
	 * @param int $numero Le numéro de l'adresse.
	 * @param string $suffixe Le suffixe de l'adresse.
	 * @param string $complement Le complément de l'adresse.
	 * @param string $nomRue Le nom de la rue.
	 * @param int $idVille La ville où est située l'adresse.
	 */
	public static function creerAdresse($numero, $suffixe, $nomRue, $complement, $idVille){
		// Préparer la requête d'insertion
		$requeteInsertion = "INSERT INTO ADRESSE (Numero, SuffixeAdresse, NomRue, ComplementAdresse, VilleAdresse) VALUES (:numero_tag, :suffixe_tag, :nomRue_tag, :complement_tag, :idVille_tag);";      
		// Connexion à la base de données
		$insertion = connexion::pdo()->prepare($requeteInsertion);
		// Définir la valeur du paramètre
		$tags = array(":numero_tag" => $numero, ":suffixe_tag" => $suffixe, ":complement_tag" => $complement, ":nomRue_tag" => $nomRue, ":idVille_tag" => $idVille);
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
	 * Renvoyer le numéro de l'adresse.
	 * @param int $numero Le numéro de l'adresse.
	 * @param string $suffixe Le suffixe de l'adresse.
	 * @param string $complement Le complément de l'adresse.
	 * @param string $nomRue Le nom de la rue.
	 * @return int $idAdresse L'identifiant de l'adresse.
	 */
	public static function getNumeroAdresse($numero, $suffixe, $complement, $nomRue, $idVille) {
		if ($suffixe == NULL){
			// Préparer la requête
			$requetePreparee = "SELECT ADRESSE.idAdresse FROM ADRESSE WHERE Numero = :num_tag AND NomRue = :nom_tag AND ComplementAdresse = :complement_tag AND VilleAdresse = :ville_tag;";
			// Définir la valeur des paramètres
			$tags = array(":num_tag" => $numero, ":nom_tag" => $nomRue, ":complement_tag" => $complement, ":ville_tag" => $idVille);
		}
		else if ($complement == NULL){
			// Préparer la requête
			$requetePreparee = "SELECT ADRESSE.idAdresse FROM ADRESSE WHERE Numero = :num_tag AND SuffixeAdresse = :suffixe_tag AND NomRue = :nom_tag AND VilleAdresse = :ville_tag;";
			// Définir la valeur des paramètres
			$tags = array(":num_tag" => $numero, ":suffixe_tag" => $suffixe, ":nom_tag" => $nomRue, ":ville_tag" => $idVille);

		}
		else if ($complement == NULL && $suffixe == NULL){
			// Préparer la requête
			$requetePreparee = "SELECT ADRESSE.idAdresse FROM ADRESSE WHERE Numero = :num_tag AND NomRue = :nom_tag AND VilleAdresse = :ville_tag;";
			// Définir la valeur des paramètres
			$valtagseurs = array(":num_tag" => $numero, ":nom_tag" => $nomRue, ":ville_tag" => $idVille);

		}
		else {
			// Préparer la requête
			$requetePreparee = "SELECT ADRESSE.idAdresse FROM ADRESSE WHERE Numero = :num_tag AND SuffixeAdresse = :suffixe_tag AND NomRue = :nom_tag AND ComplementAdresse = :complement_tag AND VilleAdresse = :ville_tag;";
			// Définir la valeur des paramètres
			$tags = array(":num_tag" => $numero, ":suffixe_tag" => $suffixe, ":nom_tag" => $nomRue, ":complement_tag" => $complement, ":ville_tag" => $idVille);
		}
		// Récupérer la requête préparée
		$recuperer_requete = connexion::pdo()->prepare($requetePreparee);
		// Exécuter la requête
		$recuperer_requete->execute($tags);
		// Récupérer le résultat renvoyé
		$idAdresse = $recuperer_requete->fetchColumn();
		// Si aucune valeur
		if ($idAdresse === false) {
			// Renvoyer null
			return null;
		}
		// Renvoyer l'identifiant
		return $idAdresse;
	}

	/**
	 * Savoir si l'adresse est déjà présent dans la base de données.
	 * @param int $numero Le numéro de l'adresse.
	 * @param string $suffixe Le suffixe de l'adresse.
	 * @param string $complement Le complément de l'adresse.
	 * @param string $nomRue Le nom de la rue.
	 * @return boolean $adresseExiste True si l'adresse est déjà présent, false sinon.
	 */
	public static function adresseExiste($numero, $suffixe, $nomRue, $complement, $idVille) {
		// Préparer la requête
		$requetePreparee = "SELECT ADRESSE.idAdresse FROM ADRESSE WHERE Numero = :num_tag AND SuffixeAdresse = :suffixe_tag AND NomRue = :nom_tag; AND ComplementAdresse = :complement_tag AND VilleAdresse = :ville_tag;";
		// Récupérer la requête préparer
		$recuperer_requete = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur des paramètres
		$tags = array(":num_tag" => $numero, ":suffixe_tag" => $suffixe, ":nom_tag" => $nomRue, ":complement_tag" => $complement, ":ville_tag" => $idVille);
		// Exécuter la requête
		$recuperer_requete->execute($tags);
		// Récupérer le résultat renvoyé 
		$nombreLignes = $recuperer_requete->fetchColumn();
		// Si la requête renvoie plus d'une ligne
		if ($nombreLignes > 0) {
			// Alors l'adresse existe
			$adresseExiste = true;
		} else {
			// Si non, l'adresse n'existe pas
			$adresseExiste = false;
		}
		// Renvoyer le boolean
		return $adresseExiste;
	}
}
?>

