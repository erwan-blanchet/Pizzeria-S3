-- LES PROCEDURES 



DELIMITER //

-- auteur (ERWAN)
-- cette procedure permet d'afficher ligne par ligne chaque salaires avec la phrase correspondantes
-- pour y proceder je stocke dans des variables le resultat de l'appel de la fonction correspondante car nous avons deja fais le calcul dans une fonction
CREATE PROCEDURE IF NOT EXISTS afficherSalaires()
BEGIN
    -- declaration des variables qui vont contenir le resultat des differentes fonctions
    DECLARE salaireLivreur INT(11);
    DECLARE salaireGestionnaire INT(11);
    DECLARE salairePizzaiolo INT(11);

    -- Appel de la première fonction
    SET salaireLivreur = retourneSalaireLivreur();
    --
    SELECT CONCAT('Somme des salaires des livreurs : ', salaireLivreur) AS Resultat;

    -- Appel de la deuxième fonction
    SET salaireGestionnaire = retourneSalaireGestionnaire();
    SELECT CONCAT('Somme des salaires des gestionnaires : ', salaireGestionnaire) AS Resultat;

    -- Appel de la troisième fonction
    SET salairePizzaiolo = retourneSalairePizzaiolo();
    SELECT CONCAT('Somme des salaires des pizzaiolos : ', salairePizzaiolo) AS Resultat;
END //








-- auteur (ERWAN)
-- cette procedure affiche toutes les boissons sur la même ligne
CREATE PROCEDURE IF NOT EXISTS afficherBoisson()
BEGIN
    -- on déclare un int en lui attribuant une valeur par défaut FALSE, elle serra utilisée comme un drapeau pour contrôler l'exécution de la boucle de la procedure
    DECLARE done INT DEFAULT FALSE;
    DECLARE affichage_produit VARCHAR(255) DEFAULT '';
    DECLARE un_produit VARCHAR(255);


    -- on declare un curseur en spécifiant la requete en dessous
    DECLARE cur CURSOR FOR
    SELECT PRODUIT.NomProduit
    FROM PRODUIT
    WHERE TypeProduit = 'Boisson';
    
    -- Cela déclare un gestionnaire (handler) qui sera activé lorsqu'une requête ne trouve plus de résultats
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    -- on ouvre le curseur
    OPEN cur;
    -- on parcours la boucle
    read_loop: LOOP
        FETCH cur INTO un_produit;
        IF done THEN
            LEAVE read_loop;
        END IF;
        -- Concaténez les boissons
        SET affichage_produit = CONCAT(affichage_produit, un_produit, ', ');
    END LOOP;
    -- fermeture du curseue
    CLOSE cur;

    -- ....TRIM(TRAILING..... j'ai trouvé ca sur internet cela permet de supprimer la virgule en trop à la fin afin d'avoir le resultat le plus propre possible à l'affichage
    SET affichage_produit = TRIM(TRAILING ', ' FROM affichage_produit);

    -- affichez le résultat sur une seule ligne
    SELECT CONCAT('Voici les boissons : ', affichage_produit) AS Resultat;
END //






-- en fonction de si en parametre on indique boisson ou dessert cela renvoie la liste de ce qu'on à saisie
-- auteur (ERWAN)
-- test avec Dessert
CREATE PROCEDURE IF NOT EXISTS afficherBoissonOuDessert(IN type VARCHAR(15))
BEGIN
-- on déclare un int en lui attribuant une valeur par défaut FALSE, elle serra utilisée comme un drapeau pour contrôler l'exécution de la boucle de la procedure
    DECLARE done INT DEFAULT FALSE;
    -- par defaut '' car au debut la chaine est vide
    DECLARE affichage_produit VARCHAR(255) DEFAULT '';
    -- declaration d'un produit qu'on ajoutera à la chaine à chaque fois
    DECLARE un_produit VARCHAR(255);


    -- Déclarez une variable pour stocker le résultat de la requête
    DECLARE cur CURSOR FOR
    SELECT PRODUIT.NomProduit
    FROM PRODUIT
    -- la condition qui doit respecter ce qui à été renseigné en paramètres
    WHERE TypeProduit = type;
-- Cela déclare un gestionnaire (handler) qui sera activé lorsqu'une requête ne trouve plus de résultats
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    -- on ouvre le curseur
    OPEN cur;
    -- on parcours la boucle
    read_loop: LOOP
        FETCH cur INTO un_produit;
        IF done THEN
            LEAVE read_loop;
        END IF;
        -- Concaténez les boissons
        SET affichage_produit = CONCAT(affichage_produit, un_produit, ', ');
    END LOOP;
    -- on ferme le curseur
    CLOSE cur;

    -- comme précedement, c'est pour un affichage plus propre
    SET affichage_produit = TRIM(TRAILING ', ' FROM affichage_produit);

    -- affichez le résultat sur une seule ligne
    SELECT CONCAT('Voici les boissons : ', affichage_produit) AS Resultat;
END //







-- cette procedure affiche les produits et ingredient vieux c'est-à-dire ceux qui ont été àcheté il y a plus d'un mois
-- pour y procéder je vais créer une table temporaire
-- auteur (ERWAN)
CREATE PROCEDURE afficherProduitsEtIngredientsVieux()
BEGIN
    -- créer une table temporaire pour stocker les résultats
    CREATE TEMPORARY TABLE IF NOT EXISTS TempResults (Resultat TEXT);

    -- sélection des produits dont la date d'achat est inférieure à un mois par rapport à la date actuelle
    INSERT INTO TempResults
    SELECT CONCAT('NomProduit: ', NomProduit, ', DateAchatProduit: ', DateAchatProduit)
    FROM PRODUIT
    -- on prend la date actuelle et on compare avec un interval d'un mois car nous voulons ceux qui ont été il y a plus d'un mois. De plus les dates sont forcément inférieures à celles d'aujourd'hui donc nous pouvons nous contenter d'un interval
    WHERE DateAchatProduit < DATE_SUB(CURDATE(), INTERVAL 1 MONTH);

    -- sélection des ingrédients dont la date d'achat est inférieure à un mois par rapport à la date actuelle
    INSERT INTO TempResults
    SELECT CONCAT('NomIngredient: ', NomIngredient, ', DateAchatIngredient: ', DateAchatIngredient)
    FROM INGREDIENT
    -- pareil pour les ingredients
    WHERE DateAchatIngredient < DATE_SUB(CURDATE(), INTERVAL 1 MONTH);

    -- afficher les résultats avec un retour à la ligne pour chaque produit ou ingrédient
    SELECT Resultat FROM TempResults;

    -- supprimer la table temporaire
    DROP TEMPORARY TABLE IF EXISTS TempResults;
END //









-- en fonction d'un nom de pizza en paramètres cette procédure renvoie la liste des ingrédients de la pizza
-- auteur (ERWAN)
-- test avec Pesto
CREATE PROCEDURE IF NOT EXISTS avoirIngredientsPizza (IN nomPizza VARCHAR(255))
BEGIN
-- on déclare un int en lui attribuant une valeur par défaut FALSE, elle serra utilisée comme un drapeau pour contrôler l'exécution de la boucle de la procedure
    DECLARE done INT DEFAULT FALSE;
    -- stock le nom de la pizza
    DECLARE nomPizza VARCHAR(255);
    
    DECLARE nomIngredient VARCHAR(255);
    DECLARE ingredientsListe VARCHAR(1024) DEFAULT '';
    
    DECLARE cur CURSOR FOR
        SELECT PIZZA.NomPizza, INGREDIENT.NomIngredient
        FROM PIZZA
        INNER JOIN compose_de ON PIZZA.idPizza = compose_de.RecettePizza
        INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient
        WHERE PIZZA.NomPizza = nom;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    -- ouverture du curseur
    OPEN cur;
    -- on boucle
    read_loop: LOOP
        FETCH cur INTO nomPizza, nomIngredient;
        IF done THEN
            LEAVE read_loop;
        END IF;
        -- on modifie la liste des ingredients en y ajoutant le nouvel ingredient
        SET ingredientsListe = CONCAT(ingredientsListe, nomIngredient, ', ');
    END LOOP;

    CLOSE cur;

    -- supprimez la virgule en trop à la fin de la chaîne pour un affichage plus joli
    SET ingredientsListe = TRIM(TRAILING ', ' FROM ingredientsListe);

    -- affiche le resultat sur une ligne
    SELECT CONCAT(nomPizza, ' possède les ingrédients : ', ingredientsListe) AS Resultat;
END //











-- renvoie les livreurs avec leurs noms et prenom qui sont disponible à la livraison
-- auteur (ERWAN)
CREATE OR REPLACE PROCEDURE avoirLivreurDispo () 
BEGIN
	SELECT INDIVIDU.nom, INDIVIDU.Prenom, LIVREUR.DisponibiliteLivreur
	FROM INDIVIDU
    INNER JOIN LIVREUR ON INDIVIDU.idIndividu = LIVREUR.idLivreur
    WHERE LIVREUR.DisponibiliteLivreur = 'Disponible';
END //



-- renvoie les livreurs avec leurs noms et prenom qui sont en mission
-- auteur (ERWAN)
CREATE OR REPLACE PROCEDURE avoirLivreurEnMission () 
BEGIN
	SELECT INDIVIDU.nom, INDIVIDU.Prenom, LIVREUR.DisponibiliteLivreur
	FROM INDIVIDU
    INNER JOIN LIVREUR ON INDIVIDU.idIndividu = LIVREUR.idLivreur
    WHERE LIVREUR.DisponibiliteLivreur = 'En cours de mission';
END //



-- renvoie les clients qui habitens dans la ville passé en paramètre
-- auteur (ERWAN)
-- test avec Orsay
CREATE PROCEDURE IF NOT EXISTS avoirClientsAvecNomVille (IN nomDeLaVille VARCHAR(255))
BEGIN
    SELECT INDIVIDU.Nom, INDIVIDU.Prenom
    FROM INDIVIDU
    INNER JOIN CLIENT ON INDIVIDU.idIndividu = CLIENT.idClient
    INNER JOIN ADRESSE ON CLIENT.AdresseClient = ADRESSE.idAdresse
    INNER JOIN VILLE ON  ADRESSE.VilleAdresse = VILLE.idVille
    WHERE VILLE.NomVille = nomDeLaVille;
END //



-- renvoie le nom du fournisseur qui a fournit le produit passé en parametres
-- auteur (ERWAN)
CREATE PROCEDURE IF NOT EXISTS avoirFournisseursAvecNomProduit(IN nomProduit VARCHAR(255))
BEGIN
	SELECT FOURNISSEUR.NomFournisseur
    FROM FOURNISSEUR
    INNER JOIN provient ON FOURNISSEUR.idFournisseur = provient.FournisseurDuProduit
    INNER JOIN PRODUIT ON provient.ProduitRecherche = PRODUIT.idProduit
    WHERE PRODUIT.NomProduit = nomProduit;
END;
//




-- renvoie les produits avec leurs stocks
-- auteur (ERWAN)
CREATE PROCEDURE IF NOT EXISTS avoirStockProduits()
BEGIN
    SELECT PRODUIT.NomProduit, PRODUIT.QuantiteEnStockProduit
    FROM PRODUIT
    -- on renvoie que lorsque le stock n'est pas vide car on a une procedure qui nous donne les stock vides
    WHERE PRODUIT.QuantiteEnStockProduit > 0;
END //



-- renvoie les ingredients avec leurs stocks
-- auteur (ERWAN)
CREATE PROCEDURE IF NOT EXISTS avoirStockIngredient()
BEGIN
    SELECT INGREDIENT.NomIngredient, INGREDIENT.QuantiteEnStockIngredient
    FROM INGREDIENT
    -- on renvoie que lorsque le stock n'est pas vide car on a une procedure qui nous donne les stock vides
    WHERE INGREDIENT.QuantiteEnStockIngredient > 0;
END //



-- renvoie les produit ou le stock est épuisé
-- auteur (ERWAN)
CREATE PROCEDURE IF NOT EXISTS avoirStockProduitsEpuise()
BEGIN
    SELECT PRODUIT.NomProduit, PRODUIT.QuantiteEnStockProduit
    FROM PRODUIT
    WHERE PRODUIT.QuantiteEnStockProduit = 0;
END //


-- renvoie les ingredients ou le stock est épuisé
-- auteur (ERWAN)
CREATE PROCEDURE IF NOT EXISTS avoirStockIngredientsEpuise()
BEGIN
    SELECT PRODUIT.NomProduit, PRODUIT.QuantiteEnStockProduit
    FROM PRODUIT
    WHERE PRODUIT.QuantiteEnStockProduit = 0;
END //




-- (fana) PROCEDURE  

-- trouvé tous les bon d'achat relié à un client par l'id du client renvoie le prénom, nom et adresse email du client ansi que la validité et la justification du bon d'achat 
CREATE PROCEDURE IF NOT EXISTS bonDachatParClientid (IN clientid INT)
BEGIN
    SELECT I.Prenom, I.Nom, I.AdresseMail, b.Utilise, j.Justification
    FROM bon_d_achat b
    JOIN JUSTIFICATIF j ON b.Raison = j.idJustificatif
    JOIN CLIENT C on b.Beneficiaire = C.idClient
    JOIN INDIVIDU I on C.idClient = I.idIndividu
    WHERE C.idClient = clientid;
END // 



-- sert à retrouver la liste (nom prénom adress email du client et la validité, justification du bon d'achat) de l'ensemble des bon d'achat rataché à un client trouvé par son nom (fanatitra rakotomavo)


 CREATE PROCEDURE IF NOT EXISTS bonDachatParClientnom (IN nom VARCHAR(30))
BEGIN
    SELECT I.Prenom, I.Nom, I.AdresseMail, b.Utilise, j.Justification
    FROM bon_d_achat b
    JOIN JUSTIFICATIF j ON b.Raison = j.idJustificatif
    JOIN CLIENT C on b.Beneficiaire = C.idClient
    JOIN INDIVIDU I on C.idClient = I.idIndividu
    WHERE I.Nom = nom;
END //



-- sert à retrouver la liste (nom prénom adress email) de l'ensemble des clients qui possède ou ont posséder un bon d'achat  (fanatitra rakotomavo)


 CREATE PROCEDURE IF NOT EXISTS clientParjustificatif (IN justificationCherche VARCHAR(100))
BEGIN
    SELECT I.Prenom, I.Nom, I.AdresseMail, b.Utilise, j.Justification
    FROM bon_d_achat b
    JOIN JUSTIFICATIF j ON b.Raison = j.idJustificatif
    JOIN CLIENT C on b.Beneficiaire = C.idClient
    JOIN INDIVIDU I on C.idClient = I.idIndividu
    WHERE j.Justification = justificationCherche;
END //



-- sert à retrouver la liste (nom prénom adress email) de l'ensemble des clients qui possède encore des bon d'achat qu'il peuvent utiliser (fanatitra rakotomavo) 


 CREATE PROCEDURE IF NOT EXISTS  clientParjustificatifvalable (IN justificationCherche VARCHAR(100)) 
BEGIN
    SELECT I.Prenom, I.Nom, I.AdresseMail, b.Utilise, j.Justification
    FROM bon_d_achat b
    JOIN JUSTIFICATIF j ON b.Raison = j.idJustificatif
    JOIN CLIENT C on b.Beneficiaire = C.idClient
    JOIN INDIVIDU I on C.idClient = I.idIndividu
    WHERE j.Justification = just AND b.Utilise = 0;
END //


-- renvoie la liste des clients habitant dans une même ville qui sera toruvé par son nom (fanatitra rakotomavo)


 CREATE PROCEDURE IF NOT EXISTS  clientsParNomVille (IN nomville VARCHAR(50))
BEGIN
     SELECT I.Prenom, I.Nom, I.AdresseMail, v.CodePostal
    FROM INDIVIDU I	
    JOIN CLIENT c on c.idClient = I.idIndividu
    JOIN ADRESSE a ON c.AdresseClient = a.idAdresse
    JOIN VILLE v ON a.VilleAdresse = v.idVille
    WHERE v.NomVille = nomville; 
END //



-- renvoie la liste des clients habitant dans une même ville qui sera toruvé par son code postal (fana)

 CREATE PROCEDURE IF NOT EXISTS clientsParVilleCodePostal (IN codePostal INT)
BEGIN
     SELECT I.Prenom, I.Nom, I.AdresseMail, v.CodePostal
    FROM INDIVIDU I	
    JOIN CLIENT c on c.idClient = I.idIndividu
    JOIN ADRESSE a ON c.AdresseClient = a.idAdresse
    JOIN VILLE v ON a.VilleAdresse = v.idVille
    WHERE v.CodePostal = codePostal;
END //


-- renvoie la liste des clients habitant dans une même ville qui sera toruvé par son code id



CREATE PROCEDURE IF NOT EXISTS clientsParVilleid (IN villeid INT)
BEGIN
     SELECT INDIVIDU.Prenom, INDIVIDU.Nom, INDIVIDU.AdresseMail, VILLE.CodePostal
    FROM INDIVIDU 	
    INNER JOIN CLIENT ON CLIENT.idClient = INDIVIDU.idIndividu
    INNER JOIN ADRESSE ON CLIENT.AdresseClient = ADRESSE.idAdresse
    INNER JOIN VILLE ON ADRESSE.VilleAdresse = VILLE.idVille
	WHERE VILLE.idVille = villeid;
END //


-- le bloc de 6 procedure qui suivront seront des revalorisation de salaire et de smic c'est à dire que en entrant un montant de revalorisation du smic n'importe quel employé qui sera payer en dessous du smic verra automatiquement sont salaire augmenter, pour la revalorisation du salaire il faudra à la fois entrée un montant comme une revalorisation du smic mais aussi un identifiant pour cibler un employé précis qui verra alors son salaire devenir celui du montant indiqué  

--  gestion  revalorisation du smic pour les livreur (fanatitra rakotoamvo)


CREATE PROCEDURE IF NOT EXISTS RevalorisationSmicLivreur(IN smicDuLivreur int)
BEGIN
  UPDATE LIVREUR
  SET LIVREUR.SalaireLivreur = smicDuLivreur 
  WHERE LIVREUR.SalaireLivreur < smicDuLivreur ;
END //



--  gestion  revalorisation du smic pour les gestionnaires (fanatitra rakotoamvo)


CREATE PROCEDURE IF NOT EXISTS RevalorisationSmicGestionnaire(IN smicDuGestionnaire int)
BEGIN
  UPDATE GESTIONNAIRE
  SET GESTIONNAIRE.SalaireGestionnaire = smicDuGestionnaire 
  WHERE GESTIONNAIRE.SalaireLivreur < smicDuGestionnaire ;
END //

-- revalorisaiton salaire d’un gestionnaire via son id (fanatitra rakotoamvo)



CREATE PROCEDURE IF NOT EXISTS RevalorisationSalaireGestionnaire(IN salaireDuGestionnaire INT, IN identifiantGestionnaire INT)
BEGIN
  UPDATE GESTIONNAIRE
  SET GESTIONNAIRE.SalaireGestionnaire = sal
  WHERE GESTIONNAIRE.idGestionnaire = identifiantGestionnaire ;
END //


 -- revalorisaiton salaire d’un PIZZAIOLOvia son id (fanatitra rakotoamvo)




CREATE OR REPLACE PROCEDURE RevalorisationSalaireLivreur (IN salaireDuLivreur INT, IN idG INT)
BEGIN
  UPDATE LIVREUR
  SET LIVREUR.SalaireLivreur = salaireDuLivreur 
  WHERE LIVREUR.idLivreur = idG;
END //




-- revalorisaiton salaire d’un PIZZAIOLOvia son id (fanatitra rakotoamvo)


CREATE OR REPLACE PROCEDURE RevalorisationSalairePizzailo (IN salairePizzaiolo INT, IN identifiantPizzailo INT)
BEGIN
UPDATE PIZZAIOLO
  SET PIZZAIOLO.SalairePizzaiolo = salairePizzaiolo 
  WHERE PIZZAIOLO.idPizzaiolo = identifiantPizzailo ;
END // 


--  gestion  revalorisation du smic pour les pizzaiolo (fanatitra rakotoamvo)



CREATE PROCEDURE IF NOT EXISTS RevalorisationSmicPizzaiolo(IN smicDuPizzaiolo int)
BEGIN
   UPDATE PIZZAIOLO
  SET PIZZAIOLO.SalairePizzaiolo = smicDuPizzaiolo 
  WHERE PIZZAIOLO.SalairePizzaiolo < smicDuPizzaiolo ;
END //





-- renvoie la liste des allergènes contenu dans une pizza qui sera trouvé via son nom (fanatitra rakotoamvo)


CREATE PROCEDURE IF NOT EXISTS pizzaAllergenesByNomPizza (IN  nompizza VARCHAR(50))
BEGIN
    SELECT a.NomAllergene, piz.NomPizza
    FROM ALLERGENE a
    JOIN possede p ON a.idAllergene = p.AllergeneContenu
    JOIN PIZZA piz ON p.PizzaAvecAllergene = piz.idPizza
    WHERE piz.NomPizza = nompizza;
END // 


-- liste (le nom la desscription le theme et son prix) l'ensemble des pizza relié par un même theme

CREATE PROCEDURE IF NOT EXISTS listPizzaParTheme (IN theme VARCHAR(50))
BEGIN
 SELECT PIZZA.NomPizza, PIZZA.DescriptionPizza, PIZZA.Theme, PIZZA.PrixPizza
    FROM PIZZA
    WHERE theme = PIZZA.Theme;
END //


 



















DELIMITER ;
