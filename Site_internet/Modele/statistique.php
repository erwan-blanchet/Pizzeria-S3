<?php
		// Faire le lien avec le fichier mère
		require_once("objet.php");

/**
 * Classe des statistiques. C'est une classe fille d'objet.
 * @author Estelle BOISSERIE
 */
class STATISTIQUE extends objet{
	//------------------------
	// ATTRIBUTS
	//------------------------
	protected static string $identifiant = "idStatistique";
	protected static string $classe = "STATISTIQUE";
	protected int $idStatistique;
	protected ?int $ChiffreDAffairesMensuel;
	protected ?int $ChiffreDAffairesHebdomadaire;
	protected ?int $ChiffreDAffairesJournalier;
	protected int $ResponsableAjoutStatistique;



	//------------------------
	// CONSTRUCTEUR
	//------------------------
	public function __construct(int $idStatistique = NULL, int $ChiffreDAffairesMensuel = NULL, int $ChiffreDAffairesHebdomadaire = NULL, int $ChiffreDAffairesJournalier = NULL, int $ResponsableAjoutStatistique = NULL){
		if(!is_null($idStatistique)){
			$this->idStatistique = $idStatistique;
			$this->ChiffreDAffairesMensuel = $ChiffreDAffairesMensuel;
			$this->ChiffreDAffairesHebdomadaire = $ChiffreDAffairesHebdomadaire;
			$this->ChiffreDAffairesJournalier = $ChiffreDAffairesJournalier;
			$this->ResponsableAjoutStatistique = $ResponsableAjoutStatistique;
		}
	}



	//------------------------
	// METHODES
	//------------------------
	public function __toString(){
		if (is_null($this->idStatistique)){
			$chaine = "Cette statistique ne figure pas dans notre base de données.";
		}
		else {
			$chaine = "Les statistiques de $this->idStatistique sont par mois : $this->ChiffreDAffairesMensuel, par semaine : $this->ChiffreDAffairesHebdomadaire et par jour : $this->ChiffreDAffairesJournalier";
		}
		return $chaine;
	}

	/**
	 * Récupérer les  année de statistiques possibles
	 * @return array $statistiquesDisponible Les statistiques
	 */
	public static function getStatistiqueId() {
		// Préparer la requête 
		$requetePreparee = "SELECT STATISTIQUE.idStatistique FROM STATISTIQUE;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			// Exécuter la requête
			$resultat->execute();
			// Récupérer le résultat
			$statistiquesDisponible = $resultat->fetchAll(); 
			// Retourner le résultat
			return $statistiquesDisponible;
		} 
		catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
		}
	}

	/**
	 * Récupérer les statistiques.
	 * @param int $id L'année de la statistique.
	 * @return array $statistiques Les statistiques.
	 */
	public static function getStatistique($id) {
		// Préparer la requête 
		$requetePreparee = "SELECT STATISTIQUE.idStatistique, STATISTIQUE.ChiffreDAffairesMensuel, STATISTIQUE.ChiffreDAffairesHebdomadaire, STATISTIQUE.ChiffreDAffairesJournalier FROM STATISTIQUE WHERE STATISTIQUE.idStatistique = :id_tag;";
		// Connexion à la base de données
		$resultat = connexion::pdo()->prepare($requetePreparee);
		// Définir la valeur du paramètre
		$tags = array(":id_tag" => $id); 
		try {
			// Exécuter la requête
			$resultat->execute($tags);
			// Récupérer les résultats
			$statistiques = $resultat->fetchAll(); 
			// Retourner le résultat
			return $statistiques;
		} catch (PDOException $e) {
			// Afficher l'erreur
			echo $e->getMessage();
			return false;
		}
	}
}
?>


