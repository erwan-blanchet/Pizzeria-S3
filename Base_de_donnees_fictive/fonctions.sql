-- LES FONCTIONS 
DELIMITER //

-- IF NOT EXISTS signifie que si la nom de la procedure ou fonction existe dÃ©ja on renvoie une erreur lors de la crÃ©ation par le mÃªme nom
-- select CONCAT(...) va concatener plusieurs chaÃ®ne simplement en les sÃ©parant par des virgules
-- pour chaque fonctions l'auteur de celle ci est indiquÃ© en amont
-- lorsque le nom de la fonction commande par get.... cela signifie qu'elle est appelé dans une autre fonction ou procédure


-- cette fonction va nous retoutner le nombre de commande qui sont arrivÃ©e hors dÃ©lai, cela va nous servir Ã  des fins de statistiques
-- pour y procÃ©der nous allons aller voir dans la table bon d'achat et compter le nombre de fois que le numÃ©ro 1 est prÃ©sent, car le numÃ©ro fait rÃ©fÃ©rence Ã  un justificatif d'une commande hors dÃ©lai
-- auteur (ERWAN)
CREATE FUNCTION IF NOT EXISTS compteCommandeHorsDelai () RETURNS INT (5)
BEGIN
	-- on dÃ©clare un int qui va s'incrÃ©menter pour chaque commande avec un hors dÃ©lai comme justificatif
	DECLARE nombre INT(11);
	-- on compte le nombre de fois qu'il revient dans la variable dÃ©clarÃ© prÃ©cedemment
	SELECT count(bon_d_achat.Raison) INTO nombre
    FROM bon_d_achat
    -- je prend bon d'achat = 1 car 1 signifit que c'est le justificatif correspondant aux hors dÃ©lai
    WHERE bon_d_achat.Raison = 1;
    -- on retourne le int
    RETURN nombre;
END //





-- cette fonction va nous permettre de connaÃ®tre le nombre de pizzaiolo disponible, pour s'organiser
-- pour y procÃ©der je vais simplement compter Ã  chaque fois dans l'attribut PIZZAIOLO.DisponibilitePizzaiolo est Ã©gale Ã  Disponible
-- j'indique que le type de retour serra un entier de taille 4
-- auteur (ERWAN)
CREATE FUNCTION IF NOT EXISTS comptePizzaioloDisponible() RETURNS INT(4)
BEGIN
	-- je dÃ©clare ma variable que je vais incrÃ©menter Ã  chaque fois
	DECLARE nombre INT (4);
    SELECT count(PIZZAIOLO.DisponibilitePizzaiolo) INTO nombre
    FROM PIZZAIOLO
    -- condiation que le pizzaiolo soit disponible
    WHERE PIZZAIOLO.DisponibilitePizzaiolo = 'Disponible';
    -- on retourne le nombre
    RETURN nombre;
END //






-- cette fonction va nous faire avoir tout les salaires
-- pour y procÃ©der je vais selectionner la somme de chaque attribut dans chacune des tables, pour chacune des tables le stocker dans un entier dÃ©clarÃ© dans la fonction, lui assigner la somme des salaires de la table correspondante. A la fin j'additionne tout dans un entier regroupant les salaires de chaque individus.
-- j'indique que le type de retout est un type entier de taille 10
-- auteur (ERWAN)
CREATE FUNCTION IF NOT EXISTS avoirToutLesSalaires() RETURNS INT (10)
BEGIN
    -- je dÃ©clare un entier qui va stocker la somme des salaires des gestionnaire de taille six pour prendre assez large tout en restant sur une taille optimisant les ressources
    DECLARE salaireGestionnaire INT (6);
    -- je dÃ©clare un entier qui va stocker la somme des salaires des pizzaiolo de taille six pour prendre assez large tout en restant sur une taille optimisant les ressources
    DECLARE salairePizzaiolo INT (6);
    -- je dÃ©clare un entier qui va stocker la somme des salaires des livreur de taille six pour prendre assez large tout en restant sur une taille optimisant les ressources
    DECLARE salaireLivreur INT (6);
    -- je dÃ©clare un entier qui va stocker la somme des salaires de tout le monde de taille dix pour prendre assez large tout en restant sur une taille optimisant les ressources
    DECLARE salaireTotal INT(10);

    -- on sÃ©lectionne la somme des gestionnaire qu'on vient stocker dans salaireGestionnaire
    SELECT 
        SUM(GESTIONNAIRE.SalaireGestionnaire) INTO salaireGestionnaire
    FROM GESTIONNAIRE;
    
    -- on sÃ©lectionne la somme des pizzaiolo qu'on vient stocker dans salairePizzaiolo
    SELECT 
        SUM(PIZZAIOLO.SalairePizzaiolo) INTO salairePizzaiolo
    FROM PIZZAIOLO;
    
    -- on sÃ©lectionne la somme des livreurs qu'on vient stocker dans salaireLivreur
    SELECT 
        SUM(LIVREUR.SalaireLivreur) INTO salaireLivreur
    FROM LIVREUR;
    
    -- on modifie la variable entière de tout les salaires en lui attribuant l'addition des salaires des livreurs, des pizzaiolo et des gestionnaires
    SET salaireTotal = salaireGestionnaire + salairePizzaiolo + salaireLivreur;
    
    -- on retourne la valeur des salaires totaux
    RETURN salaireTotal;
END //



-- cette fonction va permettre de retourner l'identifiant d'un pizzaiolo en fonction de son nom
-- pour y procéder, je passe par la table INDIVIDU pour à partir du nom aller chercher dans pizzaiolo l'identifiant
-- le type de retour de ma fonction est un entier de taille 4
-- vous pouvez tester avec Dupont 
-- auteur (ERWAN)
CREATE FUNCTION IF NOT EXISTS getIdPizzaiolo (IN nomPizzaiolo VARCHAR(255)) RETURNS INT(4)
BEGIN 
	-- variable entière qui stock l'id du pizzaiolo
	DECLARE id int(4);
	SELECT PIZZAIOLO.idPizzaiolo
    -- on indique qu'on stock le select dans id
    INTO id
    FROM PIZZAIOLO
    -- on joint INDIVIDU
    INNER JOIN INDIVIDU ON PIZZAIOLO.IndividuPizzaiolo = INDIVIDU.idIndividu
    -- condition que le nom de l'individu soit égale à celui en paramètres
    WHERE INDIVIDU.Nom = nomPizzaiolo;
    -- on retourne l'id correspondant
    RETURN id;
END //



-- cette fonction retourne le salaire des gestionnaire
-- pour y procéder je vais déclarer un entier qui va stocker la somme de tout les salaires dans la table gestionnaire et le retourner à la fin
-- auteur (ERWAN)
CREATE FUNCTION IF NOT EXISTS retourneSalaireGestionnaire () RETURNS INT(11)
BEGIN
    -- je déclare ma variable entière
	DECLARE salaireGestionnaire INT(11);
    
	SELECT SUM(GESTIONNAIRE.SalaireGestionnaire) 
    -- je spécifique qu'a chaque ligne je stock tout ca dans cette variable
    INTO salaireGestionnaire
    FROM GESTIONNAIRE;
    -- on retourne la valeur
    RETURN salaireGestionnaire;
END //





-- cette fonction retourne le salaire des livreur
-- pour y procéder je vais déclarer un entier qui va stocker la somme de tout les salaires dans la table livreur et le retourner à la fin
-- auteur (ERWAN)
CREATE FUNCTION IF NOT EXISTS retourneSalaireLivreur () RETURNS INT(11)
BEGIN
    -- je declare de type entier
	DECLARE salaireLivreur INT(11);
    -- je fais la somme des salaires dans la table livreur
	SELECT SUM(LIVREUR.SalaireLivreur) INTO salaireLivreur
    FROM LIVREUR;
    -- on retourne la variable
    RETURN salaireLivreur;
END //




-- cette fonction retourne le salaire des pizzaiolo
-- pour y procéder je vais déclarer un entier qui va stocker la somme de tout les salaires dans la table pizzaiolo et le retourner à la fin
-- auteur (ERWAN)
CREATE FUNCTION IF NOT EXISTS retourneSalairePizzaiolo () RETURNS INT(11)
BEGIN
    -- je declare ma variable
	DECLARE salairePizzaiolo INT(11);
    -- je fais la somme de tout les salaires de la table
	SELECT SUM(PIZZAIOLO.SalairePizzaiolo) INTO salairePizzaiolo
    FROM PIZZAIOLO;
    -- je retourne ma variable
    RETURN salairePizzaiolo;
END //




-- auteur (ERWAN)
-- cette fonction va nous retourner un numÃ©ro du nombre de commande faites par un livreur
-- pour y proceder je vais voir dans la table preparateur, je compte le nombre de id on le meme que celui du nom en parametre, avec une fonction je recupere l'id de mon pizzaiolo ce qui fait que j'ai juste à comparer les id et incrémenter des que je tombe dessus

-- vous pouvez tester avec Dupont
CREATE FUNCTION IF NOT EXISTS afficherNbCommandeFaiteParUnPizzaiolo (IN nomIndividu VARCHAR(255)) RETURNS INT(5)
BEGIN
	DECLARE nombreCommande INT(5);
    SELECT count(cuisine.Preparateur) into nombreCommande
    FROM cuisine
    -- je fais appel à une ancienne fonction créer en amont pour ne pas avoir d'erreur d'appel. Elle retourne l'id du pizzaiolo en fonction de son nom en parametre
    WHERE cuisine.Preparateur = getIdPizzaiolo(nomIndividu);
-- je retourne le nombre
RETURN nombreCommande;
END //




-- (fanatitra rakotomavo) fonction qui en prenant une annÃ©e en compte renvoie l'Ã©volution moyenne (en pourcentage) renvoie -3 si la comparaison est impossible 
-- test avec 2023
CREATE FUNCTION IF NOT EXISTS CalculEvolutionMoyen(anne INT) RETURNS decimal(10,2)
BEGIN
  DECLARE ChiffreAffaireMensuelDeCetteAnne DECIMAL(10,2);
  DECLARE ChiffreAffaireMensuelDeAnneAvant DECIMAL(10,2);
  DECLARE ChiffreAffaireHebdomadaireDeCetteAnne DECIMAL(10,2);
  DECLARE ChiffreAffaireHebdomadaireDeAnneAvant DECIMAL(10,2);
  DECLARE ChiffreAffaireJournalierDeCetteAnne DECIMAL(10,2);
  DECLARE ChiffreAffaireJournalierDeAnneAvant DECIMAL(10,2);
  DECLARE pourcentageEvolutionMensuel DECIMAL(10,2);
  DECLARE pourcentageEvolutionHebdomadaire DECIMAL(10,2);
  DECLARE pourcentageEvolutionJournalier DECIMAL(10,2);
  DECLARE pourcentageEvolutionMoyen DECIMAL(10,2);

  SELECT ChiffreDAffairesMensuel INTO ChiffreAffaireMensuelDeCetteAnne FROM STATISTIQUE WHERE idStatistique = anne;
  SELECT ChiffreDAffairesHebdomadaire INTO ChiffreAffaireHebdomadaireDeCetteAnne FROM STATISTIQUE WHERE idStatistique = anne;
  SELECT ChiffreDAffairesJournalier INTO ChiffreAffaireJournalierDeCetteAnne FROM STATISTIQUE WHERE idStatistique = anne;
  SELECT ChiffreDAffairesJournalier INTO ChiffreAffaireJournalierDeAnneAvant FROM STATISTIQUE WHERE idStatistique = anne - 1;
   SELECT ChiffreDAffairesMensuel INTO ChiffreAffaireMensuelDeAnneAvant FROM STATISTIQUE WHERE idStatistique = anne - 1;
   SELECT ChiffreDAffairesHebdomadaire INTO ChiffreAffaireHebdomadaireDeAnneAvant FROM STATISTIQUE WHERE idStatistique = anne - 1;
  IF ChiffreAffaireMensuelDeAnneAvant IS NOT NULL THEN
    SET pourcentageEvolutionMensuel = (ChiffreAffaireMensuelDeCetteAnne - ChiffreAffaireMensuelDeAnneAvant) / ChiffreAffaireMensuelDeAnneAvant;
  ELSE
    SET pourcentageEvolutionMensuel = -3; -- -3 car c'est une valeur impossible Ã  atteindre noramlement par consÃ©quent je l'ai utilisÃ© comme valeurs "code d'erreur" pour montrer qu'une division est imposible 
  END IF;

  IF ChiffreAffaireHebdomadaireDeAnneAvant IS NOT NULL THEN
    SET pourcentageEvolutionHebdomadaire = (ChiffreAffaireHebdomadaireDeCetteAnne - ChiffreAffaireHebdomadaireDeAnneAvant) / ChiffreAffaireHebdomadaireDeAnneAvant;
  ELSE
    SET pourcentageEvolutionHebdomadaire = -3; -- -3 car c'est une valeur impossible Ã  atteindre noramlement par consÃ©quent je l'ai utilisÃ© comme valeurs "code d'erreur" pour montrer qu'une division est imposible 
  END IF;

  IF ChiffreAffaireJournalierDeAnneAvant IS NOT NULL THEN
    SET pourcentageEvolutionJournalier = (ChiffreAffaireJournalierDeCetteAnne - ChiffreAffaireJournalierDeAnneAvant) / ChiffreAffaireJournalierDeAnneAvant;
  ELSE
    SET pourcentageEvolutionJournalier = -3; -- -3 car c'est une valeur impossible Ã  atteindre noramlement par consÃ©quent je l'ai utilisÃ© comme valeurs "code d'erreur" pour montrer qu'une division est imposible 
  END IF;

  SET pourcentageEvolutionMoyen = (pourcentageEvolutionJournalier + pourcentageEvolutionHebdomadaire + pourcentageEvolutionMensuel) / 3;

  RETURN pourcentageEvolutionMoyen;
END //





DELIMITER ;












