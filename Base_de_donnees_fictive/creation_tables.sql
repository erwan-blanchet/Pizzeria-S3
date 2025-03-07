/* ************************************************************
**                      CREATION DES TABLES                  **
** Fanatitra RAKOTOMAVO, Estelle BOISSERIE et Erwan BLANCHET **
* ************************************************************/

CREATE TABLE PAYS(
   idPays INT AUTO_INCREMENT,
   NomPays VARCHAR(30) NOT NULL,
   CONSTRAINT clePAYS PRIMARY KEY (idPays)
);

CREATE TABLE PAIEMENT(
   idPaiement INT AUTO_INCREMENT,
   Cryptogramme INT NOT NULL,
   DateDePeremption DATE NOT NULL,
   NomPorteur VARCHAR(50) NOT NULL,
   CONSTRAINT clePAIEMENT PRIMARY KEY (idPaiement)
);

CREATE TABLE INDIVIDU(
   idIndividu INT AUTO_INCREMENT,
   Nom VARCHAR(30) NOT NULL,
   Prenom VARCHAR(30),
   AdresseMail VARCHAR(80) NOT NULL,
   NumeroTelephone VARCHAR(15) NOT NULL,
   MotDePasse VARCHAR(60) NOT NULL,
   CONSTRAINT cleINDIVIDU PRIMARY KEY (idIndividu)
);

CREATE TABLE JUSTIFICATIF(
   idJustificatif INT AUTO_INCREMENT,
   Justification VARCHAR(100) NOT NULL,
   PourcentageRemise INT NOT NULL,
   CONSTRAINT cleJUSTIFICATIF PRIMARY KEY (idJustificatif)
);

CREATE TABLE PRODUIT(
   idProduit INT AUTO_INCREMENT,
   NomProduit VARCHAR(50) NOT NULL,
   DescriptionProduit VARCHAR(600),
   TypeProduit VARCHAR(8) NOT NULL,
   PrixAchatProduit INT NOT NULL,
   DateAchatProduit DATE NOT NULL,
   PhotoProduit VARCHAR(80),
   MargeProduit INT,
   PrixProduit INT,
   QuantiteEnStockProduit INT,
   CONSTRAINT clePRODUIT PRIMARY KEY (idProduit)
);

CREATE TABLE INGREDIENT(
   idIngredient INT AUTO_INCREMENT,
   NomIngredient VARCHAR(30) NOT NULL,
   PrixAchatIngredient INT NOT NULL,
   DateAchatIngredient DATE NOT NULL,
   PhotoIngredient VARCHAR(70),
   QuantiteEnStockIngredient INT,
   CONSTRAINT cleINGREDIENT PRIMARY KEY (idIngredient)
);

CREATE TABLE VILLE(
   idVille INT AUTO_INCREMENT,
   NomVille VARCHAR(50) NOT NULL,
   CodePostal INT NOT NULL,
   PaysVille INT NOT NULL,
   CONSTRAINT cleVILLE PRIMARY KEY(idVille),
   CONSTRAINT cleVillePays FOREIGN KEY(PaysVille) REFERENCES PAYS(idPays)
);

CREATE TABLE ADRESSE(
   idAdresse INT AUTO_INCREMENT,
   Numero INT NOT NULL,
   SuffixeAdresse VARCHAR(3),
   NomRue VARCHAR(80) NOT NULL,
   ComplementAdresse VARCHAR(100),
   VilleAdresse INT NOT NULL,
   CONSTRAINT cleADRESSE PRIMARY KEY(idAdresse),
   CONSTRAINT cleAdresseVille FOREIGN KEY(VilleAdresse) REFERENCES VILLE(idVille)
);

CREATE TABLE LIVREUR(
   idLivreur INT AUTO_INCREMENT,
   DisponibiliteLivreur VARCHAR(25) NOT NULL,
   SalaireLivreur INT NOT NULL,
   Capacite INT NOT NULL,
   IndividuLivreur INT NOT NULL,
   CONSTRAINT cleLIVREUR PRIMARY KEY(idLivreur),
   CONSTRAINT cleLivreurIndividu FOREIGN KEY(IndividuLivreur) REFERENCES INDIVIDU(idIndividu)
);

CREATE TABLE PIZZAIOLO(
   idPizzaiolo INT AUTO_INCREMENT,
   DisponibilitePizzaiolo VARCHAR(15) NOT NULL,
   SalairePizzaiolo INT NOT NULL,
   IndividuPizzaiolo INT NOT NULL,
   CONSTRAINT clePIZZAIOLO PRIMARY KEY(idPizzaiolo),
   CONSTRAINT clePizzaioloIndividu FOREIGN KEY(IndividuPizzaiolo) REFERENCES INDIVIDU(idIndividu)
);

CREATE TABLE GESTIONNAIRE(
   idGestionnaire INT AUTO_INCREMENT,
   SalaireGestionnaire INT NOT NULL,
   IndividuGestionnaire INT NOT NULL,
   CONSTRAINT cleGESTIONNAIRE PRIMARY KEY(idGestionnaire)
);

CREATE TABLE FOURNISSEUR(
   idFournisseur INT AUTO_INCREMENT,
   NomFournisseur VARCHAR(50) NOT NULL,
   TelephoneFournisseur VARCHAR(15),
   EmailFournisseur VARCHAR(100),
   SiteInternet VARCHAR(100),
   AdresseFournisseur INT NOT NULL,
   CONSTRAINT cleFOURNISSEUR PRIMARY KEY(idFournisseur),
   CONSTRAINT cleFournisseurAdresse FOREIGN KEY(AdresseFournisseur) REFERENCES ADRESSE(idAdresse)
);

CREATE TABLE CLIENT(
   idClient INT AUTO_INCREMENT,
   IndividuClient INT NOT NULL,
   AdresseClient INT NOT NULL,
   CONSTRAINT cleCLIENT PRIMARY KEY(idClient),
   CONSTRAINT cleClientIndividu FOREIGN KEY(IndividuClient) REFERENCES INDIVIDU(idIndividu),
   CONSTRAINT cleClientAdresse FOREIGN KEY(AdresseClient) REFERENCES ADRESSE(idAdresse)
);

CREATE TABLE PIZZA (
    idPizza INT AUTO_INCREMENT,
    NomPizza VARCHAR(50) NOT NULL,
    DescriptionPizza VARCHAR(400),
    Theme VARCHAR(20),
    MargePizza INT,
    PrixPizza INT,
    PhotoPizza VARCHAR(80),
    AjoutGestionnaire INT,
    Createur INT,
    CONSTRAINT clePIZZA PRIMARY KEY (idPizza),
    CONSTRAINT clePizzaGestionnaire FOREIGN KEY(AjoutGestionnaire) REFERENCES GESTIONNAIRE(idGestionnaire),
    CONSTRAINT clePizzaClient FOREIGN KEY(Createur) REFERENCES CLIENT(idClient)
);


CREATE TABLE ALLERGENE(
   idAllergene INT AUTO_INCREMENT,
   NomAllergene VARCHAR(30) NOT NULL,
   ResponsableAjoutAllergene INT NOT NULL,
   CONSTRAINT cleALLERGENE PRIMARY KEY (idAllergene),
   CONSTRAINT cleAllergeneGestionnaire FOREIGN KEY(ResponsableAjoutAllergene) REFERENCES GESTIONNAIRE(idGestionnaire)
);

CREATE TABLE STATISTIQUE(
   idStatistique INT,
   ChiffreDAffairesMensuel INT,
   ChiffreDAffairesHebdomadaire INT,
   ChiffreDAffairesJournalier INT,
   ResponsableAjoutStatistique INT NOT NULL,
   CONSTRAINT cleSTATISTIQUE PRIMARY KEY (idStatistique),
   CONSTRAINT cleStatistiqueGestionnaire FOREIGN KEY(ResponsableAjoutStatistique) REFERENCES GESTIONNAIRE(idGestionnaire)
);

CREATE TABLE COMMANDE(
   numCommande INT AUTO_INCREMENT,
   DateCommande DATE NOT NULL,
   StatutCommande VARCHAR(25) NOT NULL,
   DelaisLivraison INT,
   TVA INT,
   MargeCommande INT,
   TotalCommande INT,
   TotalPrixPizza INT,
   TotalPrixProduit INT,
   PaiementCommande INT,
   ClientCommande INT NOT NULL,
   CONSTRAINT cleCOMMANDE PRIMARY KEY(numCommande),
   CONSTRAINT cleCommandePaiement FOREIGN KEY(PaiementCommande) REFERENCES PAIEMENT(idPaIement),
   CONSTRAINT cleCommandeClient FOREIGN KEY(ClientCommande) REFERENCES CLIENT(idClient)
);

CREATE TABLE compose_de(
   RecettePizza INT,
   IngredientNecessaire INT,
   QuantiteDeIngredient INT NOT NULL,
   CONSTRAINT cleCOMPOSE_DE PRIMARY KEY(RecettePizza, IngredientNecessaire),
   CONSTRAINT cleRecettePizza FOREIGN KEY(RecettePizza) REFERENCES PIZZA(idPizza),
   CONSTRAINT cleIngredientNecessaire FOREIGN KEY(IngredientNecessaire) REFERENCES INGREDIENT(idIngredient)
);

CREATE TABLE est_allergique(
   ClientAllergique INT,
   AllergieDuClient INT,
   CONSTRAINT cleEST_ALLERGIQUE PRIMARY KEY(ClientAllergique, AllergieDuClient),
   CONSTRAINT cleClientAllergique FOREIGN KEY(ClientAllergique) REFERENCES CLIENT(idClient),
   CONSTRAINT cleAllergieDuClient FOREIGN KEY(AllergieDuClient) REFERENCES ALLERGENE(idAllergene)
);

CREATE TABLE commande_pizza(
   PizzaCommande INT,
   CommandeEffectue INT,
   QuantitePizza INT NOT NULL,
   CommentairePizza VARCHAR(200),
   StatutPizza VARCHAR(30) NOT NULL,
   CONSTRAINT cleCOMMANDE_PIZZA PRIMARY KEY(PizzaCommande, CommandeEffectue),
   CONSTRAINT clePizzaCommande FOREIGN KEY(PizzaCommande) REFERENCES PIZZA(idPizza),
   CONSTRAINT cleCommandeEffectue FOREIGN KEY(CommandeEffectue) REFERENCES COMMANDE(numCommande)
);

CREATE TABLE commande_produit(
   ProduitCommande INT,
   CommandeFait INT,
   QuantiteProduit INT,
   CONSTRAINT cleCOMMANDE_PRODUIT PRIMARY KEY(ProduitCommande, CommandeFait),
   CONSTRAINT cleProduitCommande FOREIGN KEY(ProduitCommande) REFERENCES PRODUIT(idProduit),
   CONSTRAINT cleCommandeFait FOREIGN KEY(CommandeFait) REFERENCES COMMANDE(numCommande)
);

CREATE TABLE livre(
   CommandeALivre INT,
   LivreurCharge INT,
   CONSTRAINT cleLIVRE PRIMARY KEY(CommandeALivre, LivreurCharge),
   CONSTRAINT cleCommandeALivre FOREIGN KEY(CommandeALivre) REFERENCES COMMANDE(numCommande),
   CONSTRAINT cleLivreurCharge FOREIGN KEY(LivreurCharge) REFERENCES LIVREUR(idLivreur)
);

CREATE TABLE cuisine(
   CommandeEmise INT,
   Preparateur INT,
   CONSTRAINT cleCUISINE PRIMARY KEY(CommandeEmise, Preparateur),
   CONSTRAINT cleCommandeEmise FOREIGN KEY(CommandeEmise) REFERENCES COMMANDE(numCommande),
   CONSTRAINT clePreparateur FOREIGN KEY(Preparateur) REFERENCES PIZZAIOLO(idPizzaiolo)
);

CREATE TABLE possede(
   PizzaAvecAllergene INT,
   AllergeneContenu INT,
   CONSTRAINT clePOSSEDE PRIMARY KEY(PizzaAvecAllergene, AllergeneContenu),
   CONSTRAINT clePizzaAvecAllergene FOREIGN KEY(PizzaAvecAllergene) REFERENCES PIZZA(idPizza),
   CONSTRAINT cleAllergeneContenu FOREIGN KEY(AllergeneContenu) REFERENCES ALLERGENE(idAllergene)
);

CREATE TABLE contient(
   ProduitAvecAllergene INT,
   AllergeneImplique INT,
   CONSTRAINT cleCONTIENT PRIMARY KEY(ProduitAvecAllergene, AllergeneImplique),
   CONSTRAINT cleProduitAvecAllergene FOREIGN KEY(ProduitAvecAllergene) REFERENCES PRODUIT(idProduit),
   CONSTRAINT cleAllergeneImplique FOREIGN KEY(AllergeneImplique) REFERENCES ALLERGENE(idAllergene)
);

CREATE TABLE est_fournit(
   IngredientRecherche INT,
   FournisseurDeIngredient INT,
   CONSTRAINT cleEST_FOURNIT PRIMARY KEY(IngredientRecherche, FournisseurDeIngredient),
   CONSTRAINT cleIngredientRecherche FOREIGN KEY(IngredientRecherche) REFERENCES INGREDIENT(idIngredient),
   CONSTRAINT cleFournisseurDeIngredient FOREIGN KEY(FournisseurDeIngredient) REFERENCES FOURNISSEUR(idFournisseur)
);

CREATE TABLE provient(
   ProduitRecherche INT,
   FournisseurDuProduit INT,
   CONSTRAINT clePROVIENT PRIMARY KEY(ProduitRecherche, FournisseurDuProduit),
   CONSTRAINT cleProduitRecherche FOREIGN KEY(ProduitRecherche) REFERENCES PRODUIT(idProduit),
   CONSTRAINT cleFournisseurDuProduit FOREIGN KEY(FournisseurDuProduit) REFERENCES FOURNISSEUR(idFournisseur)
);

CREATE TABLE bon_d_achat(
   Beneficiaire INT,
   Raison INT,
   Utilise BOOLEAN NOT NULL,
   CONSTRAINT cleBON_D_ACHAT PRIMARY KEY(Beneficiaire, Raison),
   CONSTRAINT cleBeneficiaire FOREIGN KEY(Beneficiaire) REFERENCES CLIENT(idClient),
   CONSTRAINT cleRaison FOREIGN KEY(Raison) REFERENCES JUSTIFICATIF(idJustificatif)
);