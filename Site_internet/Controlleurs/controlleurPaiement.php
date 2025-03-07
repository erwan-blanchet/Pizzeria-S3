<?php   
  // Lien avec le fichier mère 
  require_once("controlleurObjet.php");
  // Lien avec le modèle
  require_once("Modele/paiement.php");


  /**
  * Classe controlleur de PAIEMENT. C'est une classe fille de controlleurObjet.
  * @author Estelle BOISSERIE
  */
  class controlleurPaiement extends controlleurObjet {
    //---------------------
    // ATTRIBUTS
    //---------------------
    protected static string $classe="PAIEMENT";
    protected static string $identifiant = "idPaiement";


    //---------------------
    // METHODES
    //---------------------
    /**
     * Payer une commande
     */
    public static function paiement(){
      // Vérifier si le formulaire a été soumis
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["valider"])) {

        // Récupérer les données saisies
        $cryptogramme = $_POST["cryptogramme"];
        $datePeremption = $_POST["datePeremption"];
        $nom = $_POST["nom"];

        // Appeler les fichiers
        require_once("./Modele/paiement.php");
        require_once("./Modele/commande.php");

        // Créer le paiment
        paiement::creerPaiement($cryptogramme, $datePeremption, $nom);

        // Récupérer l'identifiant du paiement
        $idPaiement = paiement::getIdentifiantPaiement($cryptogramme, $datePeremption, $nom);
        // Récupérer le numéro de commande depuis la session
        $numeroCommande = $_SESSION['numeroCommande'];

        // Modifier le status du paiement
        commande::modifCommandePayee($numeroCommande, $idPaiement);

        // Afficher une nouvelle page
        controlleurObjet::paiementConfirme();
      }
    }
  }
?>