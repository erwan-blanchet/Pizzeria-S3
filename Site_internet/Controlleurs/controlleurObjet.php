<?php   
		/**
		 * Classe controlleur de STATISTIQUE. C'est une classe fille de controlleurObjet.
		 * @author Estelle BOISSERIE
		 */
		class controlleurObjet {  
	//---------------------
	// METHODES
	//---------------------
	/**
	 * Lancer la page d'acceuil
	 */
	public static function lancer() {
		// Créer le titre
		$titre = "Bienvenue chez CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/menu.html");
		include("./Vues/acceuil.html");
		include("./Vues/fin.html");
	}

	/**
	 * Lancer la page des pizzas
	 */
	public static function acceuilPizzas(){
		// Créer le titre
		$titre = "Découvrez nos pizzas chez CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/menu.html");
		include("./Vues/pizzas.html");
		include("./Vues/fin.html");
	}

	/**
	 * Lancer la page des boissons
	 */
	public static function acceuilBoissons(){
		// Créer le titre
		$titre = "Découvrez nos boissons chez CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/menu.html");
		include("./Vues/boissons.html");
		include("./Vues/fin.html");
	}

	/**
	 * Lancer la page des desserts
	 */
	public static function acceuilDesserts(){
		// Créer le titre
		$titre = "Découvrez nos desserts chez CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/menu.html");
		include("./Vues/desserts.html");
		include("./Vues/fin.html");
	}

	/**
	 * Connexion
	 */
	public static function connexion() {
		// Créer le titre
		$titre = "Bienvenue chez CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/connexion.html");
		include("./Vues/fin.html");
	}

	/**
	 * Appeler la méthode de connexion
	 */
	public static function connecter(){
		// Inclure le controlleur d'individu
		require_once("controlleurIndividu.php"); 
		// Appeler la méthode
		controlleurIndividu::connecter();
	}

	/**
	 * Lancer la page d'acceuil des clients
	 */
	public static function acceuilClient(){
		// Vérifier si le client est connecté en vérifiant la présence de l'ID du client dans la session
		if (isset($_SESSION['idClient'])) {
			// Récupérer les informations du client depuis la session
			$infoClient = isset($_SESSION['infoClient']) ? $_SESSION['infoClient'] : null;
			// Vérifier si les informations du client existent
			if ($infoClient !== null && isset($infoClient['Nom'])) {
				// Récupérer le nom du client
				$nomClient = $infoClient['Nom'];
				$prenomClient = $infoClient['Prenom'];
				// Utiliser le nom dans le titre de la page
				$titre = "Bonjour " . $nomClient . " " . $prenomClient;
			}
		}
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/acceuil.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer le profil du client
	 */
	public static function profilClient(){
		//Définir le titre 
		$titre = "Votre profil";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/profil.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des pizzas 
	 */
	public static function pizzasClient(){
		//Définir le titre 
		$titre = "Nos pizzas croustiantes par ordre alphabétique";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/pizzas.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des pizzas par ordre de prix croissant
	 */
	public static function pizzasCroissant(){
		//Définir le titre 
		$titre = "Nos pizzas croustiantes par prix croissant";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Croissant/pizzasCroissant.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des pizzas par ordre de prix décroissant
	 */
	public static function pizzasDecroissant(){
		//Définir le titre 
		$titre = "Nos pizzas croustiantes par prix décroissant";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Decroissant/pizzasDecroissant.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des pizzas par ordre inverse de l'alphabet
	 */
	public static function pizzasInverseAlphabet(){
		//Définir le titre 
		$titre = "Nos pizzas croustiante par ordre inverse de l'alphabet";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Inverse/pizzasInverseAlphabet.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des boissons 
	 */
	public static function boissonsClient(){
		//Définir le titre 
		$titre = "Nos boissons par ordre alphabétique";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/boissons.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des boissons par ordre de prix croissant
	 */
	public static function boissonsCroissant(){
		//Définir le titre 
		$titre = "Nos boissons par prix croissant";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Croissant/boissonsCroissant.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des boissons par ordre de prix décroissant
	 */
	public static function boissonsDecroissant(){
		//Définir le titre 
		$titre = "Nos boissons par prix décroissant";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Decroissant/boissonsDecroissant.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des boissons par ordre inverse de l'alphabet
	 */
	public static function boissonsInverseAlphabet(){
		//Définir le titre 
		$titre = "Nos boissons par ordre inverse de l'alphabet";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Inverse/boissonsInverseAlphabet.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des desserts 
	 */
	public static function dessertsClient(){
		//Définir le titre 
		$titre = "Nos desserts par ordre alphabétique";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/desserts.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des desserts par ordre de prix croissant
	 */
	public static function dessertsCroissant(){
		//Définir le titre 
		$titre = "Nos desserts par prix croissant";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Croissant/dessertsCroissant.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des desserts par ordre de prix décroissant
	 */
	public static function dessertsDecroissant(){
		//Définir le titre 
		$titre = "Nos desserts par prix décroissant";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Decroissant/dessertsDecroissant.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des desserts par ordre inverse de l'alphabet
	 */
	public static function dessertsInverseAlphabet(){
		//Définir le titre 
		$titre = "Nos desserts par ordre inverse de l'alphabet";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Inverse/dessertsInverseAlphabet.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page de détail de pizza
	 */
	public static function detailPizza(){
		//Définir le titre 
		$titre = "Pizza";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/detailPizza.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page demande de personnalisation
	 */
	public static function demandePersonnalisation(){
		//Définir le titre 
		$titre = "Personnaliser votre pizza CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/demandePersonnalisation.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page de pizza commandée 
	 */
	public static function pizzaCommande(){
		// Récupérer l'identifiant de la pizza choisie
		$idPizza = $_GET['idPizza'];
		// Récupérer le numéro de commande depuis la session
		$numeroCommande = $_SESSION['numeroCommande'];
		// Appeler le fichier
		require_once("./Modele/commande_pizza.php");
		// Appeler la méthode 
		commande_pizza::commanderPizza($idPizza, $numeroCommande);
		// Définir le titre 
		$titre = "Pizza ajoutée au panier";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/pizzaAjoutee.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page de personnalistaion
	 */
	public static function personnaliserPizza(){
		// Définir le titre 
		$titre = "Créer votre pizza CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/personnaliser.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Valider la personnalisation du client sur une pizza
	 */
	public static function validerPersonnalisation(){
		// Définir le titre 
		$titre = "Pizza ajoutée au panier";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/pizzaAjoutee.html");
		include("./Vues/Client/fin.html");
	}    

	/**
	 * Créer une pizza personnalisé
	 */
	public static function creerPersonnalisation(){
		// Inclure le controlleur d'individu
		require_once("controlleurPizza.php"); 
		// Appeler la méthode
		controlleurPizza::creerPizzaPerso();
	} 

	/**
	 * Lancer la page des CGV et livraisons
	 */
	public static function cgv(){
		// Définir le titre 
		$titre = "Nos conditions de ventes générales et livraisons";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/menu.html");
		include("./Vues/CGV.html");
		include("./Vues/fin.html");
	}    

	/**
	 * Lancer la page des mentions légales
	 */
	public static function mentionsLegales(){
		// Définir le titre 
		$titre = "Nos mentions légales";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/menu.html");
		include("./Vues/CGV.html");
		include("./Vues/fin.html");
	} 

	/**
	 * Lancer l'acceuil du gestionnaire
	 */
	public static function acceuilGestionnaire(){
		// Vérifier si le gestionnaire est connecté en vérifiant la présence de l'ID du gestionnaire dans la session
		if (isset($_SESSION['idGestionnaire'])) {
			// Récupérer les informations du gestionnaire depuis la session
			$infoGestionnaire = isset($_SESSION['infoGestionnaire']) ? $_SESSION['infoGestionnaire'] : null;
			// Vérifier si les informations du client existent
			if ($infoGestionnaire !== null && isset($infoGestionnaire['Nom'])) {
				// Récupérer le nom du client
				$nomGestionnaire = $infoGestionnaire['Nom'];
				$prenomGestionnaire = $infoGestionnaire['Prenom'];
				// Utiliser le nom dans le titre de la page
				$titre = "Bonjour " . $nomGestionnaire . " " . $prenomGestionnaire;
			}
		}
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/acceuil.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Lancer la page des stocks
	 */
	public static function stocksGestionnaire(){
		// Définir le titre 
		$titre = "Stock de CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/stock.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Lancer la page des stocks dans l'ordre des prix décroissant
	 */
	public static function ingredientDecroissant(){
		// Définir le titre 
		$titre = "Stock de CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/Decroissant/stockDecroissant.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Lancer la page des stocks dans l'ordre des prix croissant
	 */
	public static function ingredientCroissant(){
		// Définir le titre 
		$titre = "Stock de CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/Croissant/stockCroissant.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Lancer la page des stocks dans l'ordre inverse de l'alphabet
	 */
	public static function ingredientInverseAlphabet(){
		// Définir le titre 
		$titre = "Stock de CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/Inverse/stockInverse.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Lancer la page détails des ingrédients
	 */
	public static function detailsIngredient(){
		// Définir le titre 
		$titre = "Détails";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/detailIngredient.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Lancer la page détails de la recette de la pizza
	 */
	public static function detailRecettePizza(){
		// Définir le titre 
		$titre = "Recette";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/detailPizza.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Lancer la page du profil du gestionnaire
	 */
	public static function profilGestionnaire(){
		// Définir le titre 
		$titre = "Votre profil";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/profil.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Lancer la page de détails de produit
	 */
	public static function detailProduit(){
		// Définir le titre 
		$titre = "Détail du produit";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/detailProduit.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Lancer la page de détails de produit
	 */
	public static function detailProduitClient(){
		// Définir le titre 
		$titre = "Découvrez plus en détail notre produit";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/detailProduit.html");
		include("./Vues/Client/fin.html");
	} 

	/**
	 * Lancer la page de produit commandé 
	 */
	public static function produitCommande(){
		// Récupérer l'identifiant de le produit choisie
		$idProduit = $_GET['idProduit'];
		// Récupérer le numéro de commande depuis la session
		$numeroCommande = $_SESSION['numeroCommande'];
		// Appeler le fichier
		require_once("./Modele/commande_produit.php");
		// Appeler la méthode 
		commande_produit::commanderProduit($idProduit, $numeroCommande);
		// Définir le titre 
		$titre = "Article ajouté au panier";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/produitAjoutee.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page de création de profil
	 */
	public static function creationProfil(){
		// Définir le titre 
		$titre = "Rejoignez la communauté Croustil Vintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/creerProfil.html");
		include("./Vues/fin.html");
	} 

	/**
	 * Appeler la méthode de création de profil
	 */
	public static function creerProfil(){
		// Inclure le controlleur d'individu
		require_once("controlleurIndividu.php"); 
		// Appeler la méthode
		controlleurIndividu::creer();
	}

	/**
	 * Lancer la page d'information fournisseur
	 */
	public static function infoFournisseur(){
		// Définir le titre 
		$titre = "Le(s) fournisseur(s) de votre produit";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/fournisseurProduit.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Lancer la page d'information fournisseur
	 */
	public static function infoFournisseurIngredient(){
		// Définir le titre 
		$titre = "Le(s) fournisseur(s) de votre ingrédient";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/fournisseurIngredient.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Lancer la page de détails des ingrédients d'une pizza
	 */
	public static function detailIngredient(){
		// Définir le titre 
		$titre = "Détail de l'ingrédient";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/detailIngredient.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Lancer la page de détails des produits
	 */
	public static function detailsProduitGestionnaire(){
		// Définir le titre 
		$titre = "Détail du produit";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/detailProduit.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Lancer la page de notre histoire
	 */
	public static function histoire(){
		// Définir le titre 
		$titre = "Notre histoire";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/menu.html");
		include("./Vues/histoire.html");
		include("./Vues/fin.html");
	}

	/**
	 * Lancer la page de notre histoire
	 */
	public static function histoireClient(){
		// Définir le titre 
		$titre = "Notre histoire";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/histoire.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des CGV et livraisons
	 */
	public static function cgvClient(){
		// Définir le titre 
		$titre = "Nos conditions de ventes générales et livraisons";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/cgv.html");
		include("./Vues/Client/fin.html");
	}    

	/**
	 * Lancer la page des mentions légales
	 */
	public static function mentionsLegalesClient(){
		// Définir le titre 
		$titre = "Nos mentions légales";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/cgv.html");
		include("./Vues/Client/fin.html");
	} 

	/**
	 * Déconnexion du client
	 */
	public static function deconnecterClient(){
		// Récupérer le numéro de commande depuis la session
		$numeroCommande = $_SESSION['numeroCommande'];
		// Inclure le controlleur d'individu
		require_once("./Modele/commande.php");
		// Supprimer la commande si elle n'a pas été validée 
		commande::verifierCommande($numeroCommande);
		// Supprimer la session
		session_destroy();
		// Re lancer au début
		self::lancer();
	} 

	/**
	 * Déconnexion du gestionnaire
	 */
	public static function deconnecterGestionnaire(){
		// Supprimer la session
		session_destroy();
		// Re lancer au début
		self::lancer();
	} 

	/**
	 * Lancer la page du panier
	 */
	public static function panier(){
		// Définir le titre 
		$titre = "Votre panier";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/panier.html");
		include("./Vues/Client/fin.html");
	} 

	/**
	 * Lancer la page de paiement
	 */
	public static function payer(){
		// Définir le titre 
		$titre = "Procédure de paiement";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/payer.html");
		include("./Vues/Client/fin.html");
	} 

	/**
	 * Appeler la méthode de paiement de commande
	 */
	public static function payerCommande(){
		// Inclure le controlleur d'individu
		require_once("controlleurPaiement.php"); 
		// Appeler la méthode
		controlleurPaiement::paiement();
	}

	/**
	 * Lancer la page de confirmation de paiement
	 */
	public static function paiementConfirme(){
		// Définir le titre 
		$titre = "CroustilVintage vous remercie";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/confirmationPaiement.html");
		include("./Vues/Client/fin.html");
	} 

	/**
	 * Lancer la page de consultation de ses commandes
	 */
	public static function commande(){
		// Définir le titre 
		$titre = "Vos commandes";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/commande.html");
		include("./Vues/Client/fin.html");
	} 

	/**
	 * Lancer la page de consultation des statistiques
	 */
	public static function statistiquesGestionnaire(){
		// Définir le titre 
		$titre = "Les statistiques de CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/statistique.html");
		include("./Vues/Gestionnaire/fin.html");
	} 


	/**
	 * Lancer la page de consultation des recettes
	 */
	public static function recettesGestionnaire(){
		// Définir le titre 
		$titre = "Les recettes de CroustilVintage";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/recette.html");
		include("./Vues/Gestionnaire/fin.html");
	} 

	/**
	 * Afficher la page de création d'alerte d'ingrédient
	 */
	public static function creationAlerteIngredient(){
		// Définir le titre 
		$titre = "Créer une alerte sur votre ingrédient";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/creerAlerteIngredient.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Afficher la page de création d'alerte de produit
	 */
	public static function creationAlerteProduit(){
		// Définir le titre 
		$titre = "Créer une alerte sur votre produit";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/creerAlerteProduit.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Créer une alerte de nombre minimum d'ingrédient
	 */
	public static function creerAlerteIngredient(){
		// Inclure le controlleur d'individu
		require_once("controlleurIngredient.php"); 
		// Appeler la méthode
		controlleurIngredient::creerAlerte();
	}

	/**
	 * Créer une alerte de nombre minimum d'un produit
	 */
	public static function creerAlerteProduit(){
		// Inclure le controlleur d'individu
		require_once("controlleurProduit.php"); 
		// Appeler la méthode
		controlleurProduit::creerAlerte();
	}

	/**
	 * Afficher la page de confirmation de creation d'une alerte
	 */
	public static function alerteConfirmer(){
		// Définir le titre 
		$titre = "Votre alerte a été créer";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/confirmationAlerte.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Lancer la page des pizzas personnalisées
	 */
	public static function pizzasClientPerso(){
		//Définir le titre 
		$titre = "NVs pizzas croustiantes par ordre alphabétique";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/pizzasPerso.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des pizzas personnalisées par ordre de prix croissant
	 */
	public static function pizzasCroissantPerso(){
		//Définir le titre 
		$titre = "Vos pizzas croustiantes par prix croissant";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Croissant/pizzasCroissantPerso.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des pizzas personnalisées par ordre de prix décroissant
	 */
	public static function pizzasDecroissantPerso(){
		//Définir le titre 
		$titre = "Vos pizzas croustiantes par prix décroissant";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Decroissant/pizzasDecroissantPerso.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page des pizzas personnalisées par ordre inverse de l'alphabet
	 */
	public static function pizzasInverseAlphabetPerso(){
		//Définir le titre 
		$titre = "Vos pizzas croustiante par ordre inverse de l'alphabet";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/Inverse/pizzasInverseAlphabetPerso.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page de modification de quantité de produit
	 */
	public static function modifierQuantiteProduit(){
		//Définir le titre 
		$titre = "Modifier la quantité";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/formulaireQuantiteProduit.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Lancer la page de modification de quantité de pizza
	 */
	public static function modifierQuantitePizza(){
		//Définir le titre 
		$titre = "Modifier la quantité";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Client/menu.html");
		include("./Vues/Client/formulaireQuantitePizza.html");
		include("./Vues/Client/fin.html");
	}

	/**
	 * Modifier la quantité de produit d'une commande
	 */
	public static function modificationQuantiteProduit(){
		// Inclure le controlleur de produit
		require_once("controlleurProduit.php"); 
		// Appeler la méthode
		controlleurProduit::modifierQuantite();
	}

	/**
	 * Modifier la quantité de pizza d'une commande
	 */
	public static function modificationQuantitePizza(){
		// Inclure le controlleur de pizza
		require_once("controlleurPizza.php"); 
		// Appeler la méthode
		controlleurPizza::modifierQuantite();
	}

	/**
	 * Supprimer une pizza d'une commande
	 */
	public static function supprimerPizza(){
		// Inclure le controlleur d'individu
		require_once("controlleurPizza.php"); 
		// Appeler la méthode
		controlleurPizza::modifierQuantite();
	}

	/**
	 * Supprimer un produit d'une commande
	 */
	public static function supprimerProduit(){
		// Inclure le controlleur de pizza
		require_once("controlleurPizza.php"); 
		// Appeler la méthode
		controlleurPizza::modifierQuantite();
	}

	/**
	 * Créer une pizza
	 */
	public static function creationPizzaGestionnaire(){
		// Inclure le controlleur de pizza
		require_once("controlleurPizza.php"); 
		// Appeler la méthode
		controlleurPizza::creerPizzaGestionnaire();
	}

	/**
	 * Créer un ingrédient
	 */
	public static function creationIngredientGestionnaire(){
		// Inclure le controlleur d'ingrédient
		require_once("controlleurIngredient.php"); 
		// Appeler la méthode
		controlleurIngredient::creerIngredientGestionnaire();
	}

	/**
	 * Lancer la page de création de recette
	 */
	public static function creerRecette(){
		//Définir le titre 
		$titre = "Créer une nouvelle recette";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/creerPizza.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Lancer la page de création d'ingrédient
	 */
	public static function creerIngredienGestionnaire(){
		//Définir le titre 
		$titre = "Créer une nouveau ingrédient";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/creerIngredient.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Lancer la page de création d'un produit
	 */
	public static function creerProduitGestionnaire(){
		//Définir le titre 
		$titre = "Créer une nouveau produit";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/creerProduit.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Afficher les alertes crées sur les produits
	 */
	public static function alerteCreer(){
		//Définir le titre 
		$titre = "Vos alertes";
		// Insérer les vues
		include("./Vues/debut.html");
		include("./Vues/Gestionnaire/menu.html");
		include("./Vues/Gestionnaire/afficherAlerte.html");
		include("./Vues/Gestionnaire/fin.html");
	}

	/**
	 * Supprimer une commande de pizza
	 */
	public static function supprimerCommandePizza(){
		// Inclure le controlleur d'individu
		require_once("controlleurPizza.php"); 
		// Appeler la méthode
		controlleurPizza::supprimerCommandeDePizza();
	}

	/**
	 * Supprimer une commande de produit
	 */
	public static function supprimerCommandeProduit(){
		// Inclure le controlleur d'individu
		require_once("controlleurProduit.php"); 
		// Appeler la méthode
		controlleurProduit::supprimerCommandeDeProduit();
	}

	/**
	 * Notifier la commande comme annuler
	 */
	public static function annuler(){
		// Inclure le controlleur d'individu
		require_once("./Modele/commande.php"); 
		// Récupérer le numéro de commande depuis la session
		$numeroCommande = $_SESSION['numeroCommande'];
		// Appeler la méthode
		commande::annulerCommande($numeroCommande);
		self::commande();
	}

	/**
	 * Supprimer une pizza par le gestionnaire
	 */
	public static function supprimerPizzaGestionnaire(){
		// Récupérer l'identifiant de la pizza
		$idPizza = $_GET['idPizza'];
		// Inclure le controlleur d'individu
		require_once("./Modele/pizza.php"); 
		// Appeler la méthode
		pizza::supprimerPizzaGestionnaire($idPizza);
		self::acceuilGestionnaire();
	}

	/**
	 * Supprimer un produit par le gestionnaire
	 */
	public static function supprimerProduitGestionnaire(){
		// Récupérer l'identifiant
		$idProduit = $_GET['idProduit'];
		// Inclure le controlleur d'individu
		require_once("./Modele/produit.php"); 
		// Appeler la méthode
		produit::supprimerProduitGestionnaire($idProduit);
		self::acceuilGestionnaire();
	}

	/**
	 * Supprimer un ingredient par le gestionnaire
	 */
	public static function supprimerIngredientGestionnaire(){
		// Récupérer l'identifiant
		$idIngredient = $_GET['idIngredient'];
		// Inclure le controlleur d'individu
		require_once("./Modele/ingredient.php"); 
		// Appeler la méthode
		ingredient::supprimerProduitGestionnaire($idIngredient);
		self::acceuilGestionnaire();
	}
	
	/**
	 * Notifier la commande comme livrer
	 */
	public static function livrer(){
		// Inclure le controlleur d'individu
		require_once("./Modele/commande.php"); 
		// Récupérer le numéro de commande depuis la session
		$numeroCommande = $_SESSION['numeroCommande'];
		// Appeler la méthode
		commande::livrerCommande($numeroCommande);
		self::commande();
	}
}
?>