/* ************************************************************
**                        LES DECLENCHEURS                   **
**                       Estelle BOISSERIE                   **
* *************************************************************/


DELIMITER //


/* PIZZA */
-- Déclencheur avant insertion d'une pizza --
CREATE OR REPLACE TRIGGER AlerteInsertionPizza BEFORE INSERT ON PIZZA FOR EACH ROW
BEGIN
    -- Stocker le coût total des ingrédients --
    DECLARE totalPrixIngredients INT;

    -- Stocker le chemin de la photo--
    DECLARE chemin VARCHAR(80);

    -- Paramétrer la marge --
    SET NEW.MargePizza = 2;
    
	-- Vérifier que le thème correspond à soit Hiver soit Printemps soit Ete soit Automne--
    IF NOT (NEW.Theme IN ('Ete', 'Hiver', 'Automne', 'Printemps', NULL)) THEN
        SIGNAL SQLSTATE '28001' SET MESSAGE_TEXT = 'Le thème de la pizza est incorrect. Veuillez saisir uniquement parmi : Hiver, Printemps, Ete ou Automne.';
    END IF;
    
    -- Paramétrer le chemin de l'image --
    SET chemin = CONCAT('../Images/Pizzas/', NEW.NomPizza, '.png');
    SET NEW.PhotoPizza = chemin; 

    -- Calculer le coût total des ingrédients --
    SELECT SUM(INGREDIENT.PrixAchatIngredient * compose_de.QuantiteDeIngredient)
    INTO totalPrixIngredients
    FROM compose_de
    INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient
    WHERE compose_de.RecettePizza = NEW.idPizza;

    -- Calculer le prix unitaire de la pizza --
    SET NEW.PrixPizza = NEW.MargePizza + totalPrixIngredients;

    -- Vérifier que le prix de la pizza soit positif--
    IF NOT (NEW.PrixPizza >= 0) THEN
        SIGNAL SQLSTATE '28002' SET MESSAGE_TEXT = 'Le prix de la pizza doit être positif.';
    END IF;
END; //


-- Déclencheur avant modification d'une pizza --
CREATE OR REPLACE TRIGGER AlerteModificationPizza BEFORE UPDATE ON PIZZA FOR EACH ROW
BEGIN
    -- Stocker le coût total des ingrédients --
    DECLARE totalPrixIngredients INT;

    -- Stocker le chemin de l'image--
    DECLARE chemin VARCHAR(80);

    -- Paramétrer la marge --
    SET NEW.MargePizza = 2;

	-- Vérifier que le thème correspond à soit Hiver soit Printemps soit Ete soit Automne--
    IF NOT (NEW.Theme IN ('Ete', 'Hiver', 'Automne', 'Printemps', NULL)) THEN
        SIGNAL SQLSTATE '28003' SET MESSAGE_TEXT = 'Le thème de la pizza est incorrect. Veuillez saisir uniquement parmi : Hiver, Printemps, Ete ou Automne.';
    END IF;
    
    -- Paramétrer le chemin de l'image --
    SET chemin = CONCAT('../Images/Pizzas/', NEW.NomPizza, '.png');
    SET NEW.PhotoPizza = chemin; 

    -- Calculer le coût total des ingrédients --
    SELECT SUM(INGREDIENT.PrixAchatIngredient * compose_de.QuantiteDeIngredient)
    INTO totalPrixIngredients
    FROM compose_de
    INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient
    WHERE compose_de.RecettePizza = NEW.idPizza;

    -- Calculer le prix unitaire de la pizza --
    SET NEW.PrixPizza = NEW.MargePizza + totalPrixIngredients;

    -- Vérifier que le prix de la pizza soit positif--
    IF NOT (NEW.PrixPizza >= 0) THEN
        SIGNAL SQLSTATE '28004' SET MESSAGE_TEXT = 'Le prix de la pizza doit être positif.';
    END IF;
END; //



/* STATISTIQUE */
-- Déclencheur avant insertion d'une statistique --
CREATE OR REPLACE TRIGGER AlerteInsertionStatistique BEFORE INSERT ON STATISTIQUE FOR EACH ROW
BEGIN
    -- Vérifier que la clé primaire soit composée de 4 int pour correspondre au format d'une année. Elle peut commencer seulement à 2022 car nous supposons que l'entreprise a ouvert en 2022.--
    IF NOT (LENGTH(NEW.idStatistique) = 4 AND NEW.idStatistique >= 2022 AND NEW.idStatistique <= 9999) THEN
        SIGNAL SQLSTATE '28005' SET MESSAGE_TEXT = 'La clé primaire de votre statistique ne correspond pas au format d une année.';
    END IF;

    -- Vérifier que le chiffre d'affaires mensuel est supérieur ou égal à 0 --
    IF NOT (NEW.ChiffreDAffairesMensuel >= 0) THEN
        SIGNAL SQLSTATE '28006' SET MESSAGE_TEXT = 'Le chiffre d affaires mensuel ne peut pas être négatif.';
    END IF;

    -- Vérifier que le chiffre d'affaires hebdomadaire est supérieur ou égal à 0 --
    IF NOT (NEW.ChiffreDAffairesHebdomadaire >= 0) THEN
        SIGNAL SQLSTATE '28007' SET MESSAGE_TEXT = 'Le chiffre d affaires hebdomadaire ne peut pas être négatif.';
    END IF;

    -- Vérifier que le chiffre d'affaires journalier est supérieur ou égal à 0 --
    IF NOT (NEW.ChiffreDAffairesJournalier >= 0) THEN
        SIGNAL SQLSTATE '28008' SET MESSAGE_TEXT = 'Le chiffre d affaires journalier ne peut pas être négatif.';
    END IF;
END; //

-- Déclencheur avant modification d'une statistique --
CREATE OR REPLACE TRIGGER AlerteModificationStatistique BEFORE UPDATE ON STATISTIQUE FOR EACH ROW
BEGIN
    -- Vérifier que la clé primaire soit composée de 4 int pour correspondre au format d'une année. Elle peut commencer seulement à 2022 car nous supposons que l'entreprise a ouvert en 2022.--
    IF NOT (LENGTH(NEW.idStatistique) = 4 AND NEW.idStatistique >= 2022 AND NEW.idStatistique <= 9999) THEN
        SIGNAL SQLSTATE '28009' SET MESSAGE_TEXT = 'La clé primaire de votre statistique ne correspond pas au format d une année';
    END IF;

    -- Vérifier que le chiffre d'affaires mensuel est supérieur ou égal à 0 --
    IF NOT (NEW.ChiffreDAffairesMensuel >= 0) THEN
        SIGNAL SQLSTATE '28010' SET MESSAGE_TEXT = 'Le chiffre d affaires mensuel ne peut pas être négatif.';
    END IF;

    -- Vérifier que le chiffre d'affaires hebdomadaire est supérieur ou égal à 0 --
    IF NOT (NEW.ChiffreDAffairesHebdomadaire >= 0) THEN
        SIGNAL SQLSTATE '28011' SET MESSAGE_TEXT = 'Le chiffre d affaires hebdomadaire ne peut pas être négatif.';
    END IF;

    -- Vérifier que le chiffre d'affaires journalier est supérieur ou égal à 0 --
    IF NOT (NEW.ChiffreDAffairesJournalier >= 0) THEN
        SIGNAL SQLSTATE '28012' SET MESSAGE_TEXT = 'Le chiffre d affaires journalier ne peut pas être négatif.';
    END IF;
END; //



/* PAIEMENT */
-- Déclencheur avant insertion d'un paiement --
CREATE OR REPLACE TRIGGER AlerteInsertionPaiement BEFORE INSERT ON PAIEMENT FOR EACH ROW
BEGIN
    -- Vérifier que le cryptogramme soit composé de 3 int --
    IF NOT (LENGTH(NEW.Cryptogramme) = 3 AND NEW.Cryptogramme >= 000 AND NEW.Cryptogramme <= 999) THEN
        SIGNAL SQLSTATE '28013' SET MESSAGE_TEXT = 'Le cryptogramme est invalide.';
    END IF;

    -- Vérifier que la date de péremption soit inférieur à celle d'aujourd'hui --
    IF NOT (NEW.DateDePeremption > NOW()) THEN
        SIGNAL SQLSTATE '28014' SET MESSAGE_TEXT = 'La carte est périmée.';
    END IF;
END; //

-- Déclencheur avant modification d'un paiement --
CREATE OR REPLACE TRIGGER AlerteModificationPaiement BEFORE UPDATE ON PAIEMENT FOR EACH ROW
BEGIN
    -- Vérifier que le cryptogramme soit composé de 3 int --
    IF NOT (LENGTH(NEW.Cryptogramme) = 3 AND NEW.Cryptogramme >= 000 AND NEW.Cryptogramme <= 999) THEN
        SIGNAL SQLSTATE '28015' SET MESSAGE_TEXT = 'Le cryptogramme est invalide.';
    END IF;

    -- Vérifier que la date de péremption soit inférieur à celle d'aujourd'hui --
    IF NOT (NEW.DateDePeremption > NOW()) THEN
        SIGNAL SQLSTATE '28016' SET MESSAGE_TEXT = 'La carte est périmée.';
    END IF;
END; //



/* INDIVIDU */
-- Déclencheur avant insertion d'un individu --
CREATE OR REPLACE TRIGGER AlerteInsertionIndividu BEFORE INSERT ON INDIVIDU FOR EACH ROW
BEGIN
    -- Vérifier le format d'adresse mail --
    IF NOT (NEW.AdresseMail REGEXP '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\\.[A-Z|a-z]{2,4}$') THEN
        SIGNAL SQLSTATE '28017' SET MESSAGE_TEXT = 'Le format de l adresse mail est invalide.';
    END IF;

    -- Vérifier que le format du numéro de téléphone --
    IF NOT (NEW.NumeroTelephone REGEXP '^0[1-9]([-. ]?[0-9]{2}){4}$') THEN
        SIGNAL SQLSTATE '28018' SET MESSAGE_TEXT = 'Le format du numéro de téléphone est invalide. Veuillez mettre des points entre les paires de numéro et commencer par un zéro.';
    END IF;
END; //

-- Déclencheur avant modification d'un individu --
CREATE OR REPLACE TRIGGER AlerteModificationIndividu BEFORE UPDATE ON INDIVIDU FOR EACH ROW
BEGIN
    -- Vérifier le format d'adresse mail --
    IF NOT (NEW.AdresseMail REGEXP '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\\.[A-Z|a-z]{2,4}$') THEN
        SIGNAL SQLSTATE '28019' SET MESSAGE_TEXT = 'Le format de l adresse mail est invalide.';
    END IF;

    -- Vérifier que le format du numéro de téléphone --
    IF NOT (NEW.NumeroTelephone REGEXP '^0[1-9]([-. ]?[0-9]{2}){4}$') THEN
        SIGNAL SQLSTATE '28020' SET MESSAGE_TEXT = 'Le format du numéro de téléphone est invalide. Veuillez mettre des points entre les paires de numéro et commencer par un zéro.';
    END IF;
END; //


/* JUSTIFICATIF */
-- Déclencheur avant insertion d'un justificatif --
CREATE OR REPLACE TRIGGER AlerteInsertionJustificatif BEFORE INSERT ON JUSTIFICATIF FOR EACH ROW
BEGIN
    -- Vérifier le porcentage de remise --
    IF NOT (NEW.PourcentageRemise > 0) THEN
        SIGNAL SQLSTATE '28021' SET MESSAGE_TEXT = 'Le pourcentage de remise n est pas éligible. Il doit être un entier positif.';
    END IF;
END; //

-- Déclencheur avant modification d'un justificatif --
CREATE OR REPLACE TRIGGER AlerteModificationJustificatif BEFORE UPDATE ON JUSTIFICATIF FOR EACH ROW
BEGIN
    -- Vérifier le porcentage de remise --
    IF NOT (NEW.PourcentageRemise > 0) THEN
        SIGNAL SQLSTATE '28022' SET MESSAGE_TEXT = 'Le pourcentage de remise n est pas éligible. Il doit être un entier positif.';
    END IF;
END; //


/* PRODUIT */
-- Déclencheur avant insertion d'un produit --
CREATE OR REPLACE TRIGGER AlerteInsertionProduit BEFORE INSERT ON PRODUIT FOR EACH ROW
BEGIN
    -- Stocker le chemin de la photo --
    DECLARE chemin VARCHAR(80);

    -- Paramétrer la marge --
    SET NEW.MargeProduit = 1;

    -- Vérifier que le type du produit corresponde soit à Boisson soit à dessert --
    IF NOT (NEW.TypeProduit IN ('Boisson', 'Dessert')) THEN
        SIGNAL SQLSTATE '28023' SET MESSAGE_TEXT = 'Le type de produit doit être soit une Boisson, soit un Dessert.';
    END IF;

    -- Vérifier que le prix d'achat du produit soit positif --
    IF NOT (NEW.PrixAchatProduit >= 0) THEN
        SIGNAL SQLSTATE '28023' SET MESSAGE_TEXT = 'Le prix d achat du produit doit être positif.';
    END IF;

    -- Vérifier que la quatité en stock soit positif--
    IF NOT (NEW.QuantiteEnStockProduit >= 0) THEN
        SIGNAL SQLSTATE '28024' SET MESSAGE_TEXT = 'Le quantité en stock du produit doit être positif.';
    END IF;

    -- Paramétrer le chemin de l'image --
    SET chemin = CONCAT('../Images/Produits/', NEW.NomProduit, '.png');
    SET NEW.PhotoProduit = chemin;
    
    -- Calculer le prix unitaire d'un produit --
    SET NEW.PrixProduit = NEW.MargeProduit + NEW.PrixAchatProduit;
    
    -- Vérifier que le prix de vente du produit doit être positif --
    IF NOT (NEW.PrixProduit >= 0) THEN
        SIGNAL SQLSTATE '28025' SET MESSAGE_TEXT = 'Le prix de vente du produit doit être positif.';
    END IF;

    -- Vérifier que la date d'achat du produit ne puisse pas être supérieure à aujourd'hui --
    IF NOT (NEW.DateAchatProduit < (NOW() + INTERVAL 1 DAY)) THEN
        SIGNAL SQLSTATE '28026' SET MESSAGE_TEXT = 'La date d achat du produit est impossible.';
    END IF;
END; //

-- Déclencheur avant modification d'un produit --
CREATE OR REPLACE TRIGGER AlerteModificationProduit BEFORE UPDATE ON PRODUIT FOR EACH ROW
BEGIN
    -- Stoker le chemi de l'image --
    DECLARE chemin VARCHAR(80);

    -- Paramétrer la marge --
    SET NEW.MargeProduit = 1;

    -- Vérifier que le type du produit corresponde soit à Boisson soit à dessert --
    IF NOT (NEW.TypeProduit IN ('Boisson', 'Dessert')) THEN
        SIGNAL SQLSTATE '28027' SET MESSAGE_TEXT = 'Le type de produit doit être soit une Boisson, soit un Dessert.';
    END IF;

    -- Vérifier que le prix d'achat du produit soit positif --
    IF NOT (NEW.PrixAchatProduit >= 0) THEN
        SIGNAL SQLSTATE '28028' SET MESSAGE_TEXT = 'Le prix d achat du produit doit être positif.';
    END IF;

    -- Vérifier que la quatité en stock soit positif--
    IF NOT (NEW.QuantiteEnStockProduit >= 0) THEN
        SIGNAL SQLSTATE '28029' SET MESSAGE_TEXT = 'Le quantité en stock du produit doit être positif.';
    END IF;

    -- Paramétrer le chemin de l'image --
    SET chemin = CONCAT('../Images/Produits/', NEW.NomProduit, '.png');
    SET NEW.PhotoProduit = chemin;
    
    -- Calculer le prix unitaire d'un produit --
    SET NEW.PrixProduit = NEW.MargeProduit + NEW.PrixAchatProduit;
    
     -- Vérifier que le prix de vente du produit doit être positif --
    IF NOT (NEW.PrixProduit >= 0) THEN
        SIGNAL SQLSTATE '28030' SET MESSAGE_TEXT = 'Le prix de vente du produit doit être positif.';
    END IF;

    -- Vérifier que la date d'achat du produit ne puisse pas être supérieure à aujourd'hui --
    IF NOT (NEW.DateAchatProduit < (NOW() + INTERVAL 1 DAY)) THEN
        SIGNAL SQLSTATE '28031' SET MESSAGE_TEXT = 'La date d achat du produit est impossible.';
    END IF;
END; //


/* INGREDIENT */
-- Déclencheur avant insertion d'un ingrédient --
CREATE OR REPLACE TRIGGER AlerteInsertionIngredient BEFORE INSERT ON INGREDIENT FOR EACH ROW
BEGIN
    -- Stocker le chemin de l'image --
    DECLARE chemin VARCHAR(80);

    -- Vérifier que le prix d'achat de l'ingrédient soit positif --
    IF NOT (NEW.PrixAchatIngredient >= 0) THEN
        SIGNAL SQLSTATE '28032' SET MESSAGE_TEXT = 'Le prix d achat de l ingrédient doit être positif.';
    END IF;

    -- Vérifier que la quatité en stock soit positif--
    IF NOT (NEW.QuantiteEnStockIngredient >= 0) THEN
        SIGNAL SQLSTATE '28033' SET MESSAGE_TEXT = 'Le quantité en stock de l ingrédient doit être positif.';
    END IF;

    -- Paramétrer le chemin de l'image --
    SET chemin = CONCAT('../Images/Ingredients/', NEW.NomIngredient, '.png');
    SET NEW.PhotoIngredient = chemin;

    -- Vérifier que la date d'achat ingrédient ne soit pas plus tard qu'aujourd'hui--
    IF NOT (NEW.DateAchatIngredient < (NOW() + INTERVAL 1 DAY)) THEN
        SIGNAL SQLSTATE '28034' SET MESSAGE_TEXT = 'La date d achat ne peut pas être plus tard qu aujourd hui.';
    END IF;
END; //

-- Déclencheur avant modification d'un ingédient --
CREATE OR REPLACE TRIGGER AlerteModificationIngredient BEFORE UPDATE ON INGREDIENT FOR EACH ROW
BEGIN
    -- Stocker le chemin de l'image --
    DECLARE chemin VARCHAR(70);

    -- Vérifier que le prix d'achat de l'ingrédient soit positif --
    IF NOT (NEW.PrixAchatIngredient >= 0) THEN
        SIGNAL SQLSTATE '28035' SET MESSAGE_TEXT = 'Le prix d achat de l ingrédient doit être positif.';
    END IF;

    -- Vérifier que la quatité en stock soit positif--
    IF NOT (NEW.QuantiteEnStockIngredient >= 0) THEN
        SIGNAL SQLSTATE '28036' SET MESSAGE_TEXT = 'Le quantité en stock de l ingrédient doit être positif.';
    END IF;

    -- Paramétrer le chemin de l'image --
    SET chemin = CONCAT('../Images/Ingredients/', NEW.NomIngredient, '.png');
    SET NEW.PhotoIngredient = chemin;

    -- Vérifier que la date d'achat ingrédient ne soit pas plus tard qu'aujourd'hui--
    IF NOT (NEW.DateAchatIngredient < (NOW() + INTERVAL 1 DAY)) THEN
        SIGNAL SQLSTATE '28037' SET MESSAGE_TEXT = 'La date d achat ne peut pas être plus tard qu aujourd hui.';
    END IF;
END; //


/* VILLE */
-- Déclencheur avant insertion d'une ville --
CREATE OR REPLACE TRIGGER AlerteInsertionVille BEFORE INSERT ON VILLE FOR EACH ROW
BEGIN
    -- Vérifier que le code postale soit composé de 5 int --
    IF NOT (LENGTH(NEW.CodePostal) = 5 AND NEW.CodePostal >= 00001 AND NEW.CodePostal <= 99999) THEN
        SIGNAL SQLSTATE '28038' SET MESSAGE_TEXT = 'Le code postal est invalide.';
    END IF;
END; //

-- Déclencheur avant modification d'une ville  --
CREATE OR REPLACE TRIGGER AlerteModificationVille BEFORE UPDATE ON VILLE FOR EACH ROW
BEGIN
    -- Vérifier que le code postale soit composé de 5 int --
    IF NOT (LENGTH(NEW.CodePostal) = 5 AND NEW.CodePostal >= 00001 AND NEW.CodePostal <= 99999) THEN
        SIGNAL SQLSTATE '28039' SET MESSAGE_TEXT = 'Le code postal est invalide.';
    END IF;
END; //


/* ADRESSE */
-- Déclencheur avant insertion d'une adresse --
CREATE OR REPLACE TRIGGER AlerteInsertionAdresse BEFORE INSERT ON ADRESSE FOR EACH ROW
BEGIN
    -- Vérifier que le numéro d'adresse soit supérieur à 0 --
    IF NOT (NEW.Numero > 0) THEN
        SIGNAL SQLSTATE '28040' SET MESSAGE_TEXT = 'Le numéro d adresse doit être positif';
    END IF;
END; //

-- Déclencheur avant modification d'une adresse  --
CREATE OR REPLACE TRIGGER AlerteModificationAdresse BEFORE UPDATE ON ADRESSE FOR EACH ROW
BEGIN
    -- Vérifier que le numéro d'adresse soit supérieur à 0 --
    IF NOT (NEW.Numero > 0) THEN
        SIGNAL SQLSTATE '28041' SET MESSAGE_TEXT = 'Le numéro d adresse doit être positif';
    END IF;
END; //


/* LIVREUR */
-- Déclencheur avant insertion d'un livreur --
CREATE OR REPLACE TRIGGER AlerteInsertionLivreur BEFORE INSERT ON LIVREUR FOR EACH ROW
BEGIN
    -- Vérifier que les disponibilités soit égal à Disponible, ou Indisponible, ou En cours de mission--
    IF NOT (NEW.DisponibiliteLivreur IN ('Disponible', 'Indisponible', 'En cours de mission')) THEN
        SIGNAL SQLSTATE '28042' SET MESSAGE_TEXT = 'Le statut du livreur doit être soit Disponible, soit Indisponible, soit En cours de mission';
    END IF;

    -- Vérifier que la capacite du livreur soit au moins égale à 1 --
    IF NOT (NEW.Capacite > 0) THEN
        SIGNAL SQLSTATE '28043' SET MESSAGE_TEXT = 'La capacité du livreur est insuffisante.';
    END IF;

    -- Vérifier que le salaire du livreur respecte le SMIC journée minimum (Cas où un livreur n'aurait travailleur aurait travaillé qu'une journée) --
    IF NOT (NEW.SalaireLivreur >= 80.64) THEN
        SIGNAL SQLSTATE '28043' SET MESSAGE_TEXT = 'Le salaire du livreur est inférieur au minimum légale.';
    END IF;
END; //

-- Déclencheur avant modification d'un livreur --
CREATE OR REPLACE TRIGGER AlerteModificationLivreur BEFORE UPDATE ON LIVREUR FOR EACH ROW
BEGIN
    -- Vérifier que les disponibilités soit égal à Disponible, ou Indisponible, ou En cours de mission--
    IF NOT (NEW.DisponibiliteLivreur IN ('Disponible', 'Indisponible', 'En cours de mission')) THEN
        SIGNAL SQLSTATE '28044' SET MESSAGE_TEXT = 'Le statut du livreur doit être soit Disponible, soit Indisponible, soit En cours de mission';
    END IF;

    -- Vérifier que la capacite du livreur soit au moins égale à 1 --
    IF NOT (NEW.Capacite > 0) THEN
        SIGNAL SQLSTATE '28045' SET MESSAGE_TEXT = 'La capacité du livreur est insuffisante.';
    END IF;

    -- Vérifier que le salaire du livreur respecte le SMIC journée minimum (Cas où un livreur n'aurait travailleur aurait travaillé qu'une journée) --
    IF NOT (NEW.SalaireLivreur >= 80.64) THEN
        SIGNAL SQLSTATE '28046' SET MESSAGE_TEXT = 'Le salaire du livreur est inférieur au minimum légale.';
    END IF;
END; //


/* PIZZAIOLO */
-- Déclencheur avant insertion d'un pizzaiolo --
CREATE OR REPLACE TRIGGER AlerteInsertionPizzaiolo BEFORE INSERT ON PIZZAIOLO FOR EACH ROW
BEGIN
    -- Vérifier que les disponibilités soit égal à Disponible, ou Indisponible, ou En cuisine --
    IF NOT (NEW.DisponibilitePizzaiolo IN ('Disponible', 'Indisponible', 'En cuisine')) THEN
        SIGNAL SQLSTATE '28047' SET MESSAGE_TEXT = 'Le statut du pizzaiolo doit être soit Disponible, soit Indisponible, soit En cuisine.';
    END IF;

    -- Vérifier que le salaire du pizzaiolo respecte le SMIC journée minimum (Cas où un pizzaiolo n'aurait travailleur aurait travaillé qu'une journée) --
    IF NOT (NEW.SalairePizzaiolo >= 80.64) THEN
        SIGNAL SQLSTATE '28048' SET MESSAGE_TEXT = 'Le salaire du pizzaiolo est inférieur au minimum légale.';
    END IF;
END; //

-- Déclencheur avant modification d'un pizzaiolo --
CREATE OR REPLACE TRIGGER AlerteModificationPizzaiolo BEFORE UPDATE ON PIZZAIOLO FOR EACH ROW
BEGIN
    -- Vérifier que les disponibilités soit égal à Disponible, ou Indisponible, ou En cuisine --
    IF NOT (NEW.DisponibilitePizzaiolo IN ('Disponible', 'Indisponible', 'En cuisine')) THEN
        SIGNAL SQLSTATE '28049' SET MESSAGE_TEXT = 'Le statut du pizzaiolo doit être soit Disponible, soit Indisponible, soit En cuisine.';
    END IF;

    -- Vérifier que le salaire du pizzaiolo respecte le SMIC journée minimum (Cas où un pizzaiolo n'aurait travailleur aurait travaillé qu'une journée) --
    IF NOT (NEW.SalairePizzaiolo >= 80.64) THEN
        SIGNAL SQLSTATE '28050' SET MESSAGE_TEXT = 'Le salaire du pizzaiolo est inférieur au minimum légale.';
    END IF;
END; //


/* GESTIONNAIRE */
-- Déclencheur avant insertion d'un gestionnaire --
CREATE OR REPLACE TRIGGER AlerteInsertionGestionnaire BEFORE INSERT ON GESTIONNAIRE FOR EACH ROW
BEGIN
    -- Vérifier que le salaire du gestionnaire respecte le SMIC journée minimum (Cas où un gestionnaire n'aurait travailleur aurait travaillé qu'une journée) --
    IF NOT (NEW.SalaireGestionnaire >= 80.64) THEN
        SIGNAL SQLSTATE '28051' SET MESSAGE_TEXT = 'Le salaire du gestionnaire est inférieur au minimum légale.';
    END IF;
END; //

-- Déclencheur avant modification d'un gestionnaire --
CREATE OR REPLACE TRIGGER AlerteModificationGestionnaire BEFORE UPDATE ON GESTIONNAIRE FOR EACH ROW
BEGIN
    -- Vérifier que le salaire du gestionnaire respecte le SMIC journée minimum (Cas où un gestionnaire n'aurait travailleur aurait travaillé qu'une journée) --
    IF NOT (NEW.SalaireGestionnaire >= 80.64) THEN
        SIGNAL SQLSTATE '28052' SET MESSAGE_TEXT = 'Le salaire du gestionnaire est inférieur au minimum légale.';
    END IF;
END; //


/* FOURNISSEUR */
-- Déclencheur avant insertion d'un fournisseur --
CREATE OR REPLACE TRIGGER AlerteInsertionFournisseur BEFORE INSERT ON FOURNISSEUR FOR EACH ROW
BEGIN
    -- Vérifier le format d'adresse mail --
    IF NOT (NEW.EmailFournisseur REGEXP '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\\.[A-Z|a-z]{2,4}$') THEN
        SIGNAL SQLSTATE '28053' SET MESSAGE_TEXT = 'Le format de l adresse mail est invalide.';
    END IF;

    -- Vérifier que le format du numéro de téléphone --
    IF NOT (NEW.TelephoneFournisseur REGEXP '^0[1-9]([-. ]?[0-9]{2}){4}$') THEN
        SIGNAL SQLSTATE '28054' SET MESSAGE_TEXT = 'Le format du numéro de téléphone est invalide. Veuillez mettre des points entre les paires de numéro et commencer par un zéro.';
    END IF;
    
    -- Vérifier que le format du numéro de téléphone --
    IF NOT ((NEW.TelephoneFournisseur is NULL) OR (NEW.EmailFournisseur is NULL) OR ((NEW.EmailFournisseur is NOT NULL) AND (NEW.TelephoneFournisseur is NOT NULL))) THEN
        SIGNAL SQLSTATE '28055' SET MESSAGE_TEXT = 'Il est obligatoire de renseigner soit l adresse mail du fournisseur soit le numéro de téléphone du fournisseur ou les deux.';
    END IF;
END; //
-- Déclencheur avant modification d'un fournisseur --
CREATE OR REPLACE TRIGGER AlerteModificationFournisseur BEFORE UPDATE ON FOURNISSEUR FOR EACH ROW
BEGIN
    -- Vérifier le format d'adresse mail --
    IF NOT (NEW.EmailFournisseur REGEXP '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\\.[A-Z|a-z]{2,4}$') THEN
        SIGNAL SQLSTATE '28056' SET MESSAGE_TEXT = 'Le format de l adresse mail est invalide.';
    END IF;

    -- Vérifier que le format du numéro de téléphone --
    IF NOT (NEW.TelephoneFournisseur REGEXP '^0[1-9]([-. ]?[0-9]{2}){4}$') THEN
        SIGNAL SQLSTATE '28057' SET MESSAGE_TEXT = 'Le format du numéro de téléphone est invalide. Veuillez mettre des points entre les paires de numéro et commencer par un zéro.';
    END IF;
    
    -- Vérifier que le format du numéro de téléphone --
    IF NOT ((NEW.TelephoneFournisseur is NULL) OR (NEW.EmailFournisseur is NULL) OR ((NEW.EmailFournisseur is NOT NULL) AND (NEW.TelephoneFournisseur is NOT NULL))) THEN
        SIGNAL SQLSTATE '28059' SET MESSAGE_TEXT = 'Il est obligatoire de renseigner soit l adresse mail du fournisseur soit le numéro de téléphone du fournisseur ou les deux.';
    END IF;
END; //


/* compose_de */
-- Déclencheur avant d'effectuer un lien entre une pizza et ses ingrédients --
CREATE OR REPLACE TRIGGER AlerteInsertioncompose_de BEFORE INSERT ON compose_de FOR EACH ROW
BEGIN
    -- Vérifier que la quatite de produit soit suppérieur à zéro --
    IF NOT (NEW.QuantiteDeIngredient >= 0) THEN
        SIGNAL SQLSTATE '28060' SET MESSAGE_TEXT = 'La quantité d ingrédient doit être positif.';
    END IF;
END; //

-- Déclencheur avant de modifier un lien entre une pizza et ses ingrédients --
CREATE OR REPLACE TRIGGER AlerteModificationcompose_de BEFORE UPDATE ON compose_de FOR EACH ROW
BEGIN
    -- Vérifier que la quatite de produit soit suppérieur à zéro --
    IF NOT (NEW.QuantiteDeIngredient >= 0) THEN
        SIGNAL SQLSTATE '28061' SET MESSAGE_TEXT = 'La quantité d ingrédient doit être positif.';
    END IF;
END; //

-- Déclencheur après insertion dans compose_de --
CREATE OR REPLACE TRIGGER AlerteApresInsertioncompose_de AFTER INSERT ON compose_de FOR EACH ROW
BEGIN
    -- Stocker le prix total des ingrédients composant la pizza --
    DECLARE totalPrixIngredients INT;

    -- Calculer le coût total des ingrédients --
    SELECT SUM(INGREDIENT.PrixAchatIngredient * compose_de.QuantiteDeIngredient)
    INTO totalPrixIngredients
    FROM compose_de
    INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient
    WHERE compose_de.RecettePizza = NEW.RecettePizza;

    -- Mettre à jour le prix unitaire de la pizza --
    UPDATE PIZZA
    SET PrixPizza = MargePizza + totalPrixIngredients
    WHERE idPizza = NEW.RecettePizza;
END; //

-- Déclencheur après modification dans compose_de --
CREATE OR REPLACE TRIGGER AlerteApresModificationcompose_de AFTER UPDATE ON compose_de FOR EACH ROW
BEGIN
    -- Stocker le prix total des ingrédients composant la pizza --
    DECLARE totalPrixIngredients INT;

    -- Calculer le coût total des ingrédients --
    SELECT SUM(INGREDIENT.PrixAchatIngredient * compose_de.QuantiteDeIngredient)
    INTO totalPrixIngredients
    FROM compose_de
    INNER JOIN INGREDIENT ON compose_de.IngredientNecessaire = INGREDIENT.idIngredient
    WHERE compose_de.RecettePizza = NEW.RecettePizza;

    -- Mettre à jour le prix unitaire de la pizza --
    UPDATE PIZZA
    SET PrixPizza = MargePizza + totalPrixIngredients
    WHERE idPizza = NEW.RecettePizza;
END; //


/* commande_pizza */
-- Déclencheur avant d'effectuer un lien entre des pizzas et sa commande --
CREATE OR REPLACE TRIGGER AlerteInsertioncommande_pizza BEFORE INSERT ON commande_pizza FOR EACH ROW
BEGIN
    -- Vérifier que la quatite de pizza soit suppérieur à zéro --
    IF NOT (NEW.QuantitePizza >= 0) THEN
        SIGNAL SQLSTATE '28062' SET MESSAGE_TEXT = 'La quantité de pizza doit être positif.';
    END IF;
    -- Vérifier que le statut de la pizza soit égal à En attente, ou En cours de préparation, ou Terminée --
    IF NOT (NEW.StatutPizza IN ('En attente', 'En cours de préparation', 'Terminée')) THEN
        SIGNAL SQLSTATE '28063' SET MESSAGE_TEXT = 'Le statut de la pizza doit être égal soit En attente, soit En cours de préparation, soit Terminée';
    END IF;
END; //

-- Déclencheur avant de modifier un lien entre des pizzas et sa commande --
CREATE OR REPLACE TRIGGER AlerteModificationcommande_pizza BEFORE UPDATE ON commande_pizza FOR EACH ROW
BEGIN
    -- Vérifier que la quatite de pizza soit suppérieur à zéro --
    IF NOT (NEW.QuantitePizza >= 0) THEN
        SIGNAL SQLSTATE '28064' SET MESSAGE_TEXT = 'La quantité de pizza doit être positif.';
    END IF;
    -- Vérifier que le statut de la pizza soit égal à En attente, ou En cours de préparation, ou Terminée --
    IF NOT (NEW.StatutPizza IN ('En attente', 'En cours de préparation', 'Terminée')) THEN
        SIGNAL SQLSTATE '28065' SET MESSAGE_TEXT = 'Le statut de la pizza doit être égal soit En attente, soit En cours de préparation, soit Terminée';
    END IF;
END; //

-- Déclencheur après insertion dans commande_pizza --
CREATE OR REPLACE TRIGGER AlerteApresInsertioncommande_pizza AFTER INSERT ON commande_pizza FOR EACH ROW
BEGIN
    -- Stocker le prix total des pizzas commandées --
    DECLARE totalPrix INT;

    -- Calculer le nouveau prix totales des pizzas --
    SELECT SUM(PIZZA.PrixPizza * NEW.QuantitePizza)
    INTO totalPrix
    FROM PIZZA 
    WHERE PIZZA.idPizza = NEW.PizzaCommande;

    -- Mettre à jour dans commande--
    UPDATE COMMANDE
    SET TotalPrixPizza = TotalPrixPizza + totalPrix
    WHERE numCommande = NEW.CommandeEffectue;
END; //

-- Déclencheur après modification dans commande_pizza --
CREATE OR REPLACE TRIGGER AlerteApresModificationcommande_pizza AFTER UPDATE ON commande_pizza FOR EACH ROW
BEGIN
    -- Stocker le prix total des pizzas commandées --
    DECLARE totalPrix INT;

    -- Calculer le nouveau prix totales des pizzas --
    SELECT SUM(PIZZA.PrixPizza * NEW.QuantitePizza)
    INTO totalPrix
    FROM PIZZA
    WHERE PIZZA.idPizza = NEW.PizzaCommande;

    -- Mettre à jour la commande --
    UPDATE COMMANDE
    SET TotalPrixPizza = TotalPrixPizza + totalPrix
    WHERE numCommande = NEW.CommandeEffectue;
END; //


/* commande_produit */
-- Déclencheur avant d'effectuer un lien entre des produits et sa commande --
CREATE OR REPLACE TRIGGER AlerteInsertioncommande_produit BEFORE INSERT ON commande_produit FOR EACH ROW
BEGIN
    -- Vérifier que la quatite de produits soit suppérieur à zéro --
    IF NOT (NEW.QuantiteProduit >= 0) THEN
        SIGNAL SQLSTATE '28066' SET MESSAGE_TEXT = 'La quantité de produit doit être positif.';
    END IF;
END; //

-- Déclencheur avant de modifier un lien entre des produits et sa commande --
CREATE OR REPLACE TRIGGER AlerteModificationcommande_produit BEFORE UPDATE ON commande_produit FOR EACH ROW
BEGIN
    -- Vérifier que la quatite de produits soit suppérieur à zéro --
    IF NOT (NEW.QuantiteProduit >= 0) THEN
        SIGNAL SQLSTATE '28067' SET MESSAGE_TEXT = 'La quantité de produit doit être positif.';
    END IF;
END; //

-- Déclencheur après insertion dans commande_produit --
CREATE OR REPLACE TRIGGER AlerteApresInsertioncommande_produit AFTER INSERT ON commande_produit FOR EACH ROW
BEGIN
    -- Stocker le prix total des produits commandés --
    DECLARE PrixTotal INT;

    -- Calculer le nouveau prix totales des produits --
    SELECT SUM(PRODUIT.PrixProduit * commande_produit.QuantiteProduit)
    INTO PrixTotal
    FROM commande_produit
    INNER JOIN PRODUIT ON commande_produit.ProduitCommande = PRODUIT.idProduit
    WHERE commande_produit.CommandeFait = NEW.CommandeFait;

    -- Mettre à jour la commande --
    UPDATE COMMANDE
    SET TotalPrixProduit = TotalPrixProduit + PrixTotal
    WHERE numCommande = NEW.CommandeFait;

END; //

-- Déclencheur après modification dans commande_produit --
CREATE OR REPLACE TRIGGER AlerteApresModificationcommande_produit AFTER UPDATE ON commande_produit FOR EACH ROW
BEGIN
    -- Stocker le prix total des ingrédients commandés --
    DECLARE PrixTotal INT;

    -- Calculer le nouveau prix totales des produits --
    SELECT SUM(PRODUIT.PrixProduit * commande_produit.QuantiteProduit)
    INTO PrixTotal
    FROM commande_produit
    INNER JOIN PRODUIT ON commande_produit.ProduitCommande = PRODUIT.idProduit
    WHERE commande_produit.CommandeFait = NEW.CommandeFait;

    -- Mettre à jour la commande --
    UPDATE COMMANDE
    SET TotalPrixProduit = TotalPrixProduit + PrixTotal
    WHERE numCommande = NEW.CommandeFait;
END; //


/* COMMANDE */
-- Déclencheur avant insertion d'une commande --
CREATE OR REPLACE TRIGGER AlerteInsertionCommande BEFORE INSERT ON COMMANDE FOR EACH ROW
BEGIN
    -- Déclarer la variable stockant si le client a un bon d'achat --
    DECLARE BonAchat BOOLEAN;
    DECLARE Remise INT;

    -- Initialiser les attributs --
    SET NEW.DelaisLivraison = 0;
    SET NEW.TotalPrixPizza = 0;
    SET NEW.TotalPrixProduit = 0;

    -- Mettre la TVA égale à 20 --
    SET NEW.TVA = 20;

    -- Mettre la marge de la commande égale à 5 --
    SET NEW.MargeCommande = 5;

    -- Récupérer les informations du bon d'achat et de la remise associée --
    SET BonAchat = (SELECT bon_d_achat.Utilise
                    FROM bon_d_achat
                    INNER JOIN JUSTIFICATIF ON bon_d_achat.Raison = JUSTIFICATIF.idJustificatif
                    INNER JOIN CLIENT ON bon_d_achat.Beneficiaire = CLIENT.idClient
                    WHERE CLIENT.idClient = NEW.ClientCommande);
    SET Remise = (SELECT JUSTIFICATIF.PourcentageRemise
                    FROM bon_d_achat
                    INNER JOIN JUSTIFICATIF ON bon_d_achat.Raison = JUSTIFICATIF.idJustificatif
                    INNER JOIN CLIENT ON bon_d_achat.Beneficiaire = CLIENT.idClient
                    WHERE CLIENT.idClient = NEW.ClientCommande);

    -- Vérifier que la date de la commande ne puisse pas être supérieure à aujourd'hui --
    IF NOT (NEW.DateCommande < (NOW() + INTERVAL 1 DAY)) THEN
        SIGNAL SQLSTATE '28068' SET MESSAGE_TEXT = 'La date de commande est impossible.';
    END IF;

    -- Vérifier que le statut de la commande est valide --
    IF NOT (NEW.StatutCommande IN ('Validée', 'En préparation', 'En cours', 'Prête pour livraison', 'En cours de livraison', 'Livrée', 'Annulée')) THEN
        SIGNAL SQLSTATE '28069' SET MESSAGE_TEXT = 'Le statut de la commande doit être soit Validé, soit En préparation, soit En cours, soit Prête pour livraison, soit En cours de livraison, soit Livrée, soit Annulée.';
    END IF;

    -- Calculer le prix de la commande selon si le client a un bon d'achat non utilisé ou non --
    IF BonAchat THEN
        SET NEW.TotalCommande = (NEW.MargeCommande + NEW.TotalPrixProduit + NEW.TotalPrixPizza + (NEW.TotalPrixPizza + NEW.TotalPrixProduit) * (NEW.TVA / 100)) - (Remise / 100);
    ELSE
        SET NEW.TotalCommande = NEW.MargeCommande + NEW.TotalPrixProduit + NEW.TotalPrixPizza + (NEW.TotalPrixPizza + NEW.TotalPrixProduit) * (NEW.TVA / 100);
    END IF;

    -- Vérifier que le prix de la commande doit être positif
    IF NOT (NEW.TotalCommande >= 0) THEN
        SIGNAL SQLSTATE '28070' SET MESSAGE_TEXT = 'Le prix total de la commande doit être positif.';
    END IF;

    -- Quand la commande est livrée, effacer le paiement--
    IF NEW.StatutCommande = 'Livrée' THEN
        DELETE FROM PAIEMENT WHERE PAIEMENT.idPaiement = NEW.PaiementCommande;
    END IF;
END; //
-- Déclencheur avant modification d'une commande --
CREATE OR REPLACE TRIGGER AlerteModificationCommande BEFORE UPDATE ON COMMANDE FOR EACH ROW
BEGIN
    -- Déclarer la variable stockant si le client a un bon d'achat --
    DECLARE BonAchat BOOLEAN;
    DECLARE Remise INT;

    -- Initialiser les attributs --
    SET NEW.DelaisLivraison = 0;

    -- Mettre la TVA égale à 20 --
    SET NEW.TVA = 20;

    -- Mettre la marge de la commande égale à 5 --
    SET NEW.MargeCommande = 5;

    -- Récupérer les informations du bon d'achat et de la remise associée --
    SET BonAchat = (SELECT bon_d_achat.Utilise
                    FROM bon_d_achat
                    INNER JOIN JUSTIFICATIF ON bon_d_achat.Raison = JUSTIFICATIF.idJustificatif
                    INNER JOIN CLIENT ON bon_d_achat.Beneficiaire = CLIENT.idClient
                    WHERE CLIENT.idClient = NEW.ClientCommande);
    SET Remise = (SELECT JUSTIFICATIF.PourcentageRemise
                    FROM bon_d_achat
                    INNER JOIN JUSTIFICATIF ON bon_d_achat.Raison = JUSTIFICATIF.idJustificatif
                    INNER JOIN CLIENT ON bon_d_achat.Beneficiaire = CLIENT.idClient
                    WHERE CLIENT.idClient = NEW.ClientCommande);

    -- Vérifier que la date de la commande ne puisse pas être supérieure à aujourd'hui --
    IF NOT (NEW.DateCommande < (NOW() + INTERVAL 1 DAY)) THEN
        SIGNAL SQLSTATE '28071' SET MESSAGE_TEXT = 'La date de commande est impossible.';
    END IF;

    -- Vérifier que le statut de la commande est valide --
    IF NOT (NEW.StatutCommande IN ('Validée', 'En préparation', 'En cours', 'Prête pour livraison', 'En cours de livraison', 'Livrée', 'Annulée')) THEN
        SIGNAL SQLSTATE '28072' SET MESSAGE_TEXT = 'Le statut de la commande doit être soit Validé, soit En préparation, soit En cours, soit Prête pour livraison, soit En cours de livraison, soit Livrée, soit Annulée.';
    END IF;

    -- Calculer le prix de la commande selon si le client a un bon d'achat non utilisé ou non --
    IF BonAchat THEN
        SET NEW.TotalCommande = (NEW.MargeCommande + NEW.TotalPrixProduit + NEW.TotalPrixPizza + (NEW.TotalPrixPizza + NEW.TotalPrixProduit) * (NEW.TVA / 100)) - (Remise / 100);
    ELSE
        SET NEW.TotalCommande = NEW.MargeCommande + NEW.TotalPrixProduit + NEW.TotalPrixPizza + (NEW.TotalPrixPizza + NEW.TotalPrixProduit) * (NEW.TVA / 100);
    END IF;

    -- Vérifier que le prix de la commande doit être positif
    IF NOT (NEW.TotalCommande >= 0) THEN
        SIGNAL SQLSTATE '28073' SET MESSAGE_TEXT = 'Le prix total de la commande doit être positif.';
    END IF;

    -- Quand la commande est livrée, effacer le paiement --
    IF NEW.StatutCommande = 'Livrée' THEN
        DELETE FROM PAIEMENT WHERE PAIEMENT.idPaiement = NEW.PaiementCommande;
    END IF;
END;
//


/* Alertes Gestionnaire */
-- Déclencheur pour les produits -- 
CREATE OR REPLACE TRIGGER AlerteStockProduit AFTER UPDATE ON PRODUIT FOR EACH ROW
BEGIN
    DECLARE alertMessage VARCHAR(255);

    IF (NEW.QuantiteEnStockProduit <= 5) THEN
        SET alertMessage = CONCAT(NEW.NomProduit, ' nécessite un réapprovisionnement');
        SIGNAL SQLSTATE '28074' SET MESSAGE_TEXT = alertMessage;
    END IF;
END; //
-- Déclencheur pour les ingrédients associés aux produits --
CREATE OR REPLACE TRIGGER AlerteStockIngredient AFTER UPDATE ON INGREDIENT FOR EACH ROW
BEGIN
    DECLARE alertMessage VARCHAR(255);

    IF (NEW.QuantiteEnStockIngredient <= 5) THEN
        SET alertMessage = CONCAT(NEW.NomIngredient, ' nécessite un réapprovisionnement');
        SIGNAL SQLSTATE '28075' SET MESSAGE_TEXT = alertMessage;
    END IF;
END; //
-- Déclencheur spécifique pour les tomates --
CREATE OR REPLACE TRIGGER AlerteStockTomate AFTER UPDATE ON INGREDIENT FOR EACH ROW
BEGIN
    DECLARE alertMessage VARCHAR(255);
    IF (NEW.NomIngredient = 'Tomates' AND NEW.QuantiteEnStockIngredient <= 15) THEN
        SET alertMessage = CONCAT(NEW.NomIngredient, ' nécessite un réapprovisionnement');
        SIGNAL SQLSTATE '28076' SET MESSAGE_TEXT = alertMessage;
    END IF;
END; //


/* Décrémentasion automatique des stocks */
-- Déclencheur après insertion dans commande_produit --
CREATE OR REPLACE TRIGGER MiseAJourStockProduit AFTER INSERT ON commande_produit FOR EACH ROW
BEGIN
    DECLARE Quantite INT;

    -- Obtenir la quantité en stock du produit
   SET Quantite = (SELECT QuantiteEnStockProduit 
                                FROM PRODUIT
                                 WHERE idProduit = NEW.ProduitCommande);

    IF NEW.QuantiteProduit < Quantite THEN
        -- Mettre à jour la quantité en stock du produit
        UPDATE PRODUIT
        SET QuantiteEnStockProduit = QuantiteEnStockProduit - NEW.QuantiteProduit
        WHERE idProduit = NEW.ProduitCommande;
    ELSE 
        SIGNAL SQLSTATE '28077' SET MESSAGE_TEXT = 'Le stock est insuffisant.';
    END IF;
END; //
-- Déclencheur après insertion dans commande_pizza --
CREATE OR REPLACE TRIGGER MiseAJourStockPizza BEFORE INSERT ON commande_pizza FOR EACH ROW
BEGIN
    -- Stocker les valeurs du curseur
    DECLARE id INT;
    DECLARE qtt INT;
    DECLARE qttStock INT;

    -- Déclarer la variable pour gérer le cas où aucune ligne n'est renvoyée par le curseur
    DECLARE no_rows_found BOOLEAN DEFAULT FALSE;

    -- Créer un curseur affichant la liste des ingrédients nécessaires, leurs quantités dans une pizza et la quantité des ingrédients dans le stock
    DECLARE curseur CURSOR FOR
        SELECT cd.IngredientNecessaire, cd.QuantiteDeIngredient, i.QuantiteEnStockIngredient
        FROM compose_de cd
        INNER JOIN INGREDIENT i ON cd.IngredientNecessaire = i.idIngredient
        INNER JOIN PIZZA p ON cd.RecettePizza = p.idPizza
        WHERE cd.RecettePizza = NEW.PizzaCommande
        AND cd.IngredientNecessaire IS NOT NULL
        AND cd.QuantiteDeIngredient IS NOT NULL;

    -- Déclarer un gestionnaire d'erreur pour gérer le cas où aucune ligne n'est renvoyée par le curseur
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET no_rows_found = TRUE;

    OPEN curseur;

    -- Utiliser le gestionnaire d'erreur pour quitter la boucle si aucune ligne n'est renvoyée
    FETCH_LOOP: LOOP
        FETCH curseur INTO id, qtt, qttStock;

        IF no_rows_found THEN
            LEAVE FETCH_LOOP;
        END IF;

        IF qttStock >= (qtt * NEW.QuantitePizza) THEN
            UPDATE INGREDIENT
            SET QuantiteEnStockIngredient = QuantiteEnStockIngredient - (qtt * NEW.QuantitePizza)
            WHERE idIngredient = id;
        ELSE 
            SIGNAL SQLSTATE '28078' SET MESSAGE_TEXT = 'Le stock est insuffisant.';
        END IF;
    END LOOP;

    CLOSE curseur;
END;
//
