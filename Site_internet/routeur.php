<?php
    // Valeur par défaut de l'objet
    $objet = "objet";
    // Les objets possibles
    $objets = ["objet", "Pizza", "Individu", "Ingredient", "Paiement",  "Produit"];
    // Test pour savoir si un objet correct est passé dans l'url
    if (isset($_GET["objet"]) && in_array($_GET["objet"], $objets)){
        // Si c'est le cas, on récupère l'objet passé dans l'url
        $objet = $_GET["objet"];
    }

    // Construction du contrôleur
    $controlleur = "controlleur".ucfirst($objet);
    // Insertion du contrôleur
    require_once("Controlleurs/controlleurObjet.php"); 
    require_once("Controlleurs/$controlleur.php"); 

    // Connexion
    require_once("config/connexion.php");
    // Connecter
    connexion::connect();

    // Action par défaut
    $action = "lancer";
    // Les actions possibles
    $actions = ["lancer", "connexion", "pizzaTheme","connecter", "getBoissonsALaUne", "getDessertsALaUne", "acceuilClient", "acceuilPizzas", "acceuilBoissons", "acceuilDesserts", "profilClient", "pizzasClient", "pizzasInverseAlphabet", "pizzasCroissant",
     "pizzasDecroissant", "boissonsClient", "boissonsInverseAlphabet", "boissonsCroissant", "boissonsDecroissant", "dessertsClient", 
     "dessertsInverseAlphabet", "dessertsCroissant", "dessertsDecroissant", "detailPizza", "demandePersonnalisation", "pizzaCommande",
      "personnaliserPizza", "cgv", "mentionsLegales", "validerPersonnalisation", "acceuilGestionnaire", "stocksGestionnaire", 
      "ingredientDecroissant", "ingredientCroissant", "ingredientInverseAlphabet", "detailsIngredient", "detailRecettePizza", 
      "profilGestionnaire", "detailProduit", "produitCommande", "detailProduitClient", "creationProfil", "creerProfil", "creer", 
      "infoFournisseur", "detailIngredient", "histoire", "histoireClient", "cgvClient", "mentionsLegalesClient", "deconnecterClient", 
      "deconnecterGestionnaire", "panier", "payer", "payerCommande", "paiementConfirme", "commande", "statistiquesGestionnaire", 
      "infoFournisseurIngredient", "recettesGestionnaire", "detailsProduitGestionnaire", "creerAlerteIngredient", "creerAlerteProduit", 
      "alerteConfirmer","creationAlerteProduit", "creationAlerteIngredient", "creerPersonnalisation", "pizzasClientPerso", "pizzasCroissantPerso",
        "pizzasDecroissantPerso", "pizzasInverseAlphabetPerso", "modifierQuantiteProduit", "modifierQuantitePizza", "modificationQuantiteProduit",
        "modificationQuantitePizza", "supprimerPizza", "supprimerProduit", "creationPizzaGestionnaire", "creerRecette", "alerteCreer", 
        "supprimerCommandePizza", "supprimerCommandeProduit", "annuler", "livrer", "creationIngredientGestionnaire", "creationProduitGestionnaire",
         "creerIngredienGestionnaire", "supprimerProduitGestionnaire", "supprimerIngredienGestionnaire", "supprimerPizzaGestionnaire"];

    // Test pour savoir si une action correcte est passée dans l'url
    if (isset($_GET["action"]) && in_array($_GET["action"], $actions)){
        // Si c'est le cas, on récupère l'action passée dans l'url
        $action = $_GET["action"];
    }

    session_start();
    $controlleur::$action();
?>
