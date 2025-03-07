<?php   

		// Lien avec le fichier mère 
		require_once("controlleurObjet.php");
// Lien avec les modèles
require_once("Modele/individu.php");
require_once("Modele/client.php");
require_once("Modele/gestionnaire.php");
require_once("Modele/commande.php");

/**
 * Classe controlleur de INDIVIDU. C'est une classe fille de controlleurObjet.
 * @author Estelle BOISSERIE
 */
class controlleurIndividu extends controlleurObjet {
	//---------------------
	// ATTRIBUTS
	//---------------------
	protected static string $classe="INDIVIDU";
	protected static string $identifiant = "idIndividu";



	//---------------------
	// METHODES
	//---------------------
	/**
	 * Permettre à l'utilisateur de se connecter.
	 */
	public static function connecter() {
		// Définir le titre de la page
		$titre = "Connexion ";

		// Vérifier que les informations saisient soit non null et les récupérer
		$mail = isset($_POST["mail"]) ? $_POST["mail"] : null;
		$mdp = isset($_POST["mot_de_passe"]) ? $_POST["mot_de_passe"] : null;

		// Si la vérification renvoie True
		if (individu::verifierConnexion($mail,$mdp) == TRUE) {

			// ENREGISTRER LES SESSIONS
			// Si c'est un client
			if(client::estClient($mail, $mdp) == TRUE ) {
				// Récupérer l'identifiant du client
				$idClient = client::getNumeroClient($mail, $mdp);
				// Enregistrer la session du client
				$_SESSION['idClient'] = $idClient;
				// Récupérer les informations du client
				$infoClient = individu::getInfoClient($idClient);
				// Enregistrer les informations du client dans la session
				$_SESSION['infoClient'] = $infoClient;
			}
			// Si c'est un gestionnaire
			else if(gestionnaire::estGestionnaire($mail, $mdp) == TRUE ) {
				// Récupérer l'identifiant du gestionnaire
				$idGestionnaire = gestionnaire::getNumeroGestionnaire($mail, $mdp);
				// Enregistrer la session du client
				$_SESSION['idGestionnaire'] = $idGestionnaire;
				// Récupérer les informations du gestionnaire
				$infoGestionnaire = individu::getInfoClient($idGestionnaire);
				// Enregistrer les informations du gestionnaire dans la session
				$_SESSION['infoGestionnaire'] = $infoGestionnaire;
			}

			// ADAPTER LES VUES
			// Si l'individu est un client
			if(client::estClient($mail, $mdp) == TRUE){
				// Préparer la requête d'insertion
				$requeteInsertion = "INSERT INTO COMMANDE (DateCommande, StatutCommande, PaiementCommande, ClientCommande) VALUES (CURDATE(), 'En cours', null, :id_tag);";
				// Connexion à la base de données
				$insertion = connexion::pdo()->prepare($requeteInsertion);
				// Récupérer l'identifiant du client
				$idClient = client::getNumeroClient($mail, $mdp);
				// Définir la valeur du paramètre
				$tags = array(":id_tag" => $idClient);
				try {
					// Exécuter la requête
					$insertion->execute($tags);
				} 
				catch (PDOException $e) {
					// Afficher l'erreur
					echo $e->getMessage();
				}
				// Recuperer l'identifiant de la commande
				$numeroCommande = commande::getNumeroCommande($idClient);
				// Enregistrer la session du client
				$_SESSION['numeroCommande'] = $numeroCommande;
				// Affichage des vues adaptées
				controlleurObjet::acceuilClient();
			} 
			// Si l'individu est un gestionnaire
			else {
				// Affichage des vues adaptées
				controlleurObjet::acceuilGestionnaire();
			}       
		}
		// Si les informations renseignées sont mauvaises 
		else {
			// Ouvrir une fenêtre pop up informant de l'erreur de connexion
			echo '<script>';
			echo 'function ouvrirPopup() {';
			echo 'window.open(\'./Vues/alerteErreurConnexion.html\', \'Erreur de connexion\', \'width=500,height=400\');';
			echo '}';
			echo 'window.onload = ouvrirPopup;';
			echo '</script>';
			// Re-afficher la page de connexion
			controlleurObjet::connexion();
			exit;
		}
	}

	/**
	 * Créer une personne.
	 */
	public static function creer(){
		// Vérifier si le formulaire a été soumis
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["validerCreation"])) {

			// Récupérer les informations saisies et vérifier si elles sont nulles
			$nom = $_POST["nom"];
			$prenom = isset($_POST["prenom"])? $_POST["prenom"] : NULL;  
			$mail = $_POST["email"];
			$telephone = $_POST["telephone"];
			$mdp = $_POST["motDePasse"];
			$confirmationMDP = $_POST["confirmationMotDePasse"];
			$roleClient = isset($_POST["roleClient"]) ? $_POST["roleClient"] : NULL;
			$roleGestionnaire = isset($_POST["roleGestionnaire"]) ? $_POST["roleGestionnaire"] : NULL;

			// Si c'est un client
			if ($roleClient == "client") {
				// Récupérer les informations complémentaires saisient pas le client et vérifier si elles sont nulles
				$numero = isset($_POST["numero"]) ? $_POST["numero"] : NULL;
				$suffixe = isset($_POST["suffixe"]) ? $_POST["suffixe"] : NULL;
				$complement = isset($_POST["complement"]) ? $_POST["complement"] : NULL;          
				$nomRue = $_POST["nomRue"];
				$ville = $_POST["ville"];
				$codePostal = $_POST["codePostal"];
				$pays = $_POST["pays"];

				// Appeler les fichiers
				require_once("./Modele/client.php");
				require_once("./Modele/pays.php");
				require_once("./Modele/ville.php");
				require_once("./Modele/adresse.php");
				require_once("./Modele/individu.php");

				// Si le pays existe déjà
				if (pays::paysExiste($pays) == FALSE){
					// Créer le pays
					pays::creerPays($pays);
					// Récupérer l'identifiant du pays
					$idPays = pays::getNumeroPays($pays);
				}
				else{
					// Récupérer l'identifiant du pays
					$idPays = pays::getNumeroPays($pays);
				}
				// Si la ville existe déjà
				if(ville::villeExiste($ville, $codePostal, $idPays) == FALSE){
					// Créer la ville
					ville::creerVille($ville, $codePostal, $idPays);
					// Récupérer l'identifiant de la ville
					$idVille = ville::getNumeroVille($ville, $codePostal, $idPays);
				}
				else{
					// Récupérer l'identifiant de la ville
					$idVille = ville::getNumeroVille($ville, $codePostal, $idPays);
				}
				// Si la ville existe
				if (adresse::adresseExiste($numero, $suffixe, $nomRue, $complement, $idVille) == FALSE){
					// Créer l'adresse
					adresse::creerAdresse($numero, $suffixe, $nomRue, $complement, $idVille);
					// Récupérer l'identifiant de l'adresse
					$idAdresse = adresse::getNumeroAdresse($numero, $suffixe, $nomRue, $complement, $idVille);
				}
				else{
					// Récupérer l'identifiant de l'adresse
					$idAdresse = adresse::getNumeroAdresse($numero, $suffixe, $nomRue, $complement, $idVille);
				}
				// Si l'individu existe
				if (individu::individuExiste($mail, $mdp) == FALSE){
					// Créer l'individu
					individu::creerIndividu($nom, $prenom, $mail, $telephone, $mdp, $confirmationMDP);
					// Récupérer l'identifiant de l'individu
					$idIndividu = individu::getNumeroIndividu($mail, $mdp);
				}
				else{
					// Récupérer l'identifiant de l'individu
					$idIndividu = individu::getNumeroIndividu($mail, $mdp);
				}
				// Si le client existe
				if (client::clientExiste($idIndividu, $idAdresse) == FALSE){
					// Créer le client
					client::creerClient($idIndividu, $idAdresse);
				}
				// Ouvrir une fenêtre pop up informant de la création du compte
				echo '<script>';
				echo 'function ouvrirPopup() {';
				echo 'window.open(\'./Vues/alerteCreationCompte.html\', \'Création du compte effectuée\', \'width=500,height=400\');';
				echo '}';
				echo 'window.onload = ouvrirPopup;';
				echo '</script>';
				// Re-afficher la page de connexion
				controlleurObjet::connexion();
			} 
			// Si c'est un gestionnaire
			elseif ($roleGestionnaire == "gestionnaire") {
				// Récupérer le code saisit par l'utilisateur
				$code = isset($_POST["code"]);
				// Si le code correspond à un supposer prédéfinit
				if ($code == "SAE"){
					// Appeler les fichiers
					require_once("./Modele/client.php");
					require_once("./Modele/individu.php");

					// Si l'individu existe
					if (individu::individuExiste($mail, $mdp) == FALSE){
						// Créer l'individu
						individu::creerIndividu($nom, $prenom, $mail, $telephone, $mdp, $confirmationMDP);
						// Récupérer l'identifiant de l'individu
						$idIndividu = individu::getNumeroIndividu($mail, $mdp);
					}
					else{
						// Récupérer l'identifiant de l'individu
						$idIndividu = individu::getNumeroIndividu($mail, $mdp);
					}
					// Si le gestionnaire existe
					if (gestionnaire::gestionnaireExiste($idIndividu) == FALSE){
						// Créer le gestionnaire
						gestionnaire::creerGestionnaire($idIndividu);
					}
					else{
						echo "Un compte existe déjà.";
					}
					// Ouvrir une fenêtre pop up informant de la création du compte
					echo '<script>';
					echo 'function ouvrirPopup() {';
					echo 'window.open(\'./Vues/alerteCreationCompte.html\', \'Création du compte effectuée\', \'width=500,height=400\');';
					echo '}';
					echo 'window.onload = ouvrirPopup;';
					echo '</script>';
					// Re-afficher la page de connexion
					controlleurObjet::connexion();
				}
				// Si le code gestionnaire saisit n'est pas le bon
				else {
					// Informer de l'erreur
					echo "Code de gestionnaire incorrecte.";
				}
			} 
			// Si l'utilisateur n'a pas coché de case
			else {
				// Afficher un message demande de cocher
				echo "Veuillez sélectionner cocher une case.";
			}
		}
	}
}
?>