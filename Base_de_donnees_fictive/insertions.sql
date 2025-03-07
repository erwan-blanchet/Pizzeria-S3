/* ************************************************************
**                        LES INSERTIONS                     **
**           Estelle BOISSERIE et Erwan BLANCHET             **
* *************************************************************/

-- Insertion des pays --
INSERT INTO PAYS (NomPays) VALUES
('France');

-- Insertion des paiements --
INSERT INTO PAIEMENT (Cryptogramme, DateDePeremption, NomPorteur) VALUES
(121, '2024-12-01', 'Dupont'),
(122, '2025-11-01', 'Martin'),
(123, '2024-10-01', 'Dubois'),
(124, '2027-09-01', 'Lefevre'),
(125, '2025-08-01', 'Girard'),
(126, '2033-07-01', 'Leroux'),
(127, '2035-06-01', 'Moreau'),
(128, '2037-05-01', 'Roux'),
(129, '2039-04-01', 'Garnier'),
(130, '2041-03-01', 'Picard');

-- Insertion des individus --
INSERT INTO INDIVIDU (Nom, Prenom, AdresseMail, NumeroTelephone, MotDePasse) VALUES
('Dupont', 'Jean', 'jean.dupont@email.com', '01.52.52.52.82', 'motdepasse123'),
('Martin', 'Sophie', 'sophie.martin@email.com', '01.56.25.26.24', 'pass123'),
('Dubois', 'Pierre', 'pierre.dubois@email.com', '08.52.36.54.69', 'securepass'),
('Lefevre', 'Marie', 'marie.lefevre@email.com', '07.65.95.28.25', 'mdp456'),
('Girard', 'Thomas', 'thomas.girard@email.com', '06.25.36.14.59', '123456'),
('Leroux', 'Charlotte', 'charlotte.leroux@email.com', '06.58.23.23.52', 'mdp789'),
('Moreau', 'Alexandre', 'alexandre.moreau@email.com', '06.55.47.15.86', 'pass567'),
('Roux', 'Camille', 'camille.roux@email.com', '06.08.74.22.74', 'password'),
('Garnier', 'Lucie', 'lucie.garnier@email.com', '02.36.53.25.25', 'luciepass'),
('Picard', 'Antoine', 'antoine.picard@email.com', '02.25.36.15.54', 'picard123'),
('Dupont', 'Christophe', 'christophe.dupont@email.com', '03.25.65.95.85', 'motdepasse124'),
('Smith', 'Jessica', 'jessica.smith@email.com', '06.58.25.95.32', 'pass124'),
('Johnson', 'Michael', 'michael.johnson@email.com', '07.52.62.52.25', 'securepass'),
('Brown', 'Amanda', 'amanda.brown@email.com', '08.52.62.52.36', 'mdp457'),
('Davis', 'Benjamin', 'benjamin.davis@email.com', '07.25.36.85.65', '123457'),
('Wilson', 'Christopher', 'christopher.wilson@email.com', '07.58.69.62.14', 'mdp790'),
('Moore', 'Olivia', 'olivia.moore@email.com', '06.58.32.65.14', 'pass568'),
('Anderson', 'Ethan', 'ethan.anderson@email.com', '07.61.25.63.25', 'password'),
('Harris', 'Lily', 'lily.harris@email.com', '06.25.36.25.32', 'luciepass'),
('Patel', 'Ava', 'ava.patel@email.com', '06.25.95.45.85', 'picard124'),
('Lee', 'Noah', 'noah.lee@email.com', '07.58.95.62.24', 'motdepasse125'),
('Garcia', 'Isabella', 'isabella.garcia@email.com', '08.65.32.15.68', 'pass125'),
('Martinez', 'James', 'james.martinez@email.com', '07.25.36.52.14', 'securepass'),
('Robinson', 'Sophia', 'sophia.robinson@email.com', '05.26.25.36.32', 'mdp458'),
('White', 'Emily', 'emily.white@email.com', '05.26.32.25.25', '123458'),
('Robert', 'Nick', 'nick.robert@email.com', '06.25.32.25.95', 'motPasse234'),
('Johnson', 'John', 'john.johsnon@email.com', '06.25.95.35.54', 'Amstramgram'),
('Mike', 'Chris', 'chris.mike@email.com', '07.52.51.65.32', 'cricri');

-- Insertions des justificatifs --
INSERT INTO JUSTIFICATIF (Justification, PourcentageRemise) VALUES
('Délai de 45 minutes écoulé', 50),
('Erreur légère', 5),
('Erreur lourde', 10),
('Client est venu chercher sa commande à la pizzeria', 10);

-- Insertion des produits --
INSERT INTO PRODUIT (NomProduit, DescriptionProduit, TypeProduit, PrixAchatProduit, DateAchatProduit, QuantiteEnStockProduit) VALUES
('Fanta Orange', 'Une boisson pétillante et rafraîchissante qui offre une explosion de saveur d orange. Avec son équilibre parfait d arômes naturels et artificiels, chaque gorgée apporte une expérience fruitée et sucrée. L eau carbonatée ajoute une effervescence vive, tandis que l acide citrique offre une légère note acidulée. Cette boisson colorée et pétillante est la solution idéale pour étancher votre soif avec une touche d agrume en chaque délicieux instant.' , 'Boisson', 1, '2023-11-30', 340),
('Coca-Cola', 'Une boisson gazeuse classique au goût inimitable. Avec sa formule secrète et ses arômes distincts, chaque gorgée offre une expérience pétillante et sucrée. L eau carbonatée donne une effervescence vive, tandis que le mélange unique d extraits naturels et d additifs crée le goût signature. Cette boisson emblématique, servie froide avec des glaçons, incarne le rafraîchissement depuis des décennies, symbolisant la convivialité et la satisfaction à chaque moment.' , 'Boisson', 1, '2023-11-28', 220),
('Cocal-Cola Zéro', 'La version sans sucre de l emblématique boisson gazeuse. Une expérience rafraîchissante qui conserve le goût signature du Coca-Cola, mais sans les calories. La formule unique, avec des édulcorants artificiels, offre une alternative légère et sans sucre ajouté. Avec une effervescence vive, cette boisson reste fidèle à l essence du Coca-Cola, offrant une option rafraîchissante pour ceux qui recherchent le plaisir pétillant sans compromis calorique.' , 'Boisson', 1, '2023-10-10', 450),
('Pepsi', 'Une boisson gazeuse appréciée pour son goût audacieux et rafraîchissant. Avec une formule unique d arômes et d ingrédients, chaque gorgée offre une expérience équilibrée entre douceur et piquant. L eau pétillante donne une effervescence vive, tandis que le cola distinctif crée une saveur inimitable. Cette boisson emblématique est synonyme de moments conviviaux et de rafraîchissement, offrant une alternative appréciée pour les amateurs de cola à la recherche d une expérience gustative pleine de vitalité.', 'Boisson', 1, '2022-07-05', 90),
('Pepsi Max', 'La version sans sucre de Pepsi, offre un goût intense sans compromis. Cette boisson gazeuse audacieuse combine l effervescence rafraîchissante de Pepsi avec zéro calorie. La formule distinctive, avec des édulcorants artificiels, maintient le profil de saveur distinctif de Pepsi. Une expérience pétillante et pleine de caractère, idéale pour ceux qui apprécient l intensité du cola sans les calories. Pepsi Max incarne le plaisir rafraîchissant sans sucre, offrant une option énergisante pour chaque occasion.', 'Boisson', 1, '2022-08-05', 250),
('Oasis Tropical', 'Une boisson fruitée et rafraîchissante qui évoque les tropiques à chaque gorgée. Cette boisson sans alcool mêle les saveurs ensoleillées de fruits tropicaux tels que la mangue, l ananas et la passion. L eau gazeuse donne une légère effervescence, tandis que les arômes naturels créent un équilibre harmonieux. Une expérience gustative exotique qui apporte un vent de fraîcheur, idéale pour ceux en quête d une boisson fruitée et pétillante pour égayer leur journée.', 'Boisson', 1, '2023-04-09', 230),
('Lipton Ice Tea Pêche', 'Une boisson glacée rafraîchissante qui marie le thé glacé authentique à la douceur de la pêche. Avec son infusion de thé noir de qualité, cette boisson offre une expérience délicieusement équilibrée entre le goût rafraîchissant du thé glacé et la saveur sucrée de la pêche. L eau légèrement gazeuse ajoute une touche pétillante, créant une boisson estivale parfaite pour étancher la soif et savourer le mariage subtil du thé et de la pêche, idéale pour se désaltérer sous le soleil.', 'Boisson', 1, '2023-04-09', 140),
('Tiramisu', 'Un dessert italien classique composé de couches de biscuits à la cuillère imbibés de café fort, alternant avec une crème mascarpone sucrée et saupoudrée de cacao en poudre.', 'Dessert', 2, '2023-11-27', 120),
('Clafoutis', 'Un dessert français à base de cerises, incorporés dans une pâte à flan légère à base de farine, d''œufs, de lait et de sucre, puis cuit au four.', 'Dessert', 3, '2023-11-18', 300),
('Tarte au chocolat', 'Une tarte gourmande avec une croûte croustillante, remplie d''une ganache au chocolat riche et lisse, offrant une expérience chocolatée intense.', 'Dessert', 4, '2023-10-29', 80),
('Muffin aux fruits rouges', 'Un petit gâteau individuel, sucré et aux fruits rouges, avec une texture moelleuse.', 'Dessert', 4, '2023-11-10', 110),
('Muffin aux pépites de chocolat', 'Un petit gâteau individuel,sucré et aux pépites de chocolat, avec une texture moelleuse.', 'Dessert', 4, '2023-11-10', 90);

-- Insertions des ingrédients --
INSERT INTO INGREDIENT (NomIngredient, PrixAchatIngredient, DateAchatIngredient, QuantiteEnStockIngredient) VALUES
('Basilic', 1, '2023-01-10', 400),
('Tomate', 1, '2023-01-12', 600),
('Mozzarella', 2, '2023-01-15', 350),
('Pepperoni', 3, '2023-01-16', 240),
('Champignon', 1, '2023-03-17', 730),
('Poivron', 2, '2023-08-13', 490),
('Olive', 1, '2023-01-19', 450),
('Fromage bleu', 5, '2023-11-20', 190),
('Gorgonzola', 5, '2023-03-21', 305),
('Ricotta', 6, '2023-01-22', 380),
('Poulet', 5, '2023-01-23', 520),
('Sauce barbecue', 2, '2023-11-24', 680),
('Jambon', 5, '2023-12-01', 420),
('Ananas', 3, '2023-01-06', 60),
('Pesto', 2, '2023-12-01', 150),
('Burrata', 6, '2023-11-22', 500),
('Salade', 1, '2023-01-29', 410),
('Capre', 2, '2023-01-30', 700),
('Saumon', 8, '2023-01-31', 480),
('Aubergine', 3, '2023-02-01', 860);

-- Insertion des villes --
INSERT INTO VILLE (NomVille, CodePostal, PaysVille) VALUES
('Orsay', 91400, 1),
('Evry', 91000, 1),
('Palaiseau', 91120, 1),
('Gif-sur-Yvette', 91190, 1),
('Etampes', 91150, 1),
('Viry-Chatillon', 91170, 1),
('Lisses', 91090, 1),
('Montgeron', 91230, 1),
('Massy', 91300, 1),
('Paris', 75001, 1),
('Lyon', 69002, 1),
('Marseille', 13008, 1),
('Toulouse', 31000, 1),
('Lille', 59000, 1),
('Nantes', 44000, 1),
('Strasbourg', 67000, 1),
('Annecy', 74000, 1),
('Bordeaux', 33000, 1);

-- Insertion des adresses --
INSERT INTO ADRESSE (Numero, SuffixeAdresse, NomRue, ComplementAdresse, VilleAdresse) VALUES
(1, 'Bis', 'Rue de Versailles', null, 1),
(2, 'Ter', 'Rue de l Abbaye', null, 4),
(79, 'Bis', 'Rue Francoeur', null, 6),
(104, 'Ter', 'Avenue de la gare', null, 9),
(10, 'Bis', 'Place René Haby', 'Appartement numéro 53 à l etage 2', 8),
(102, 'Bis', 'Rue de Corbeil', 'Etage 4 appartement 56', 7),
(9, null, 'Avenue de l Europe', null, 2),
(24, null, 'Place des Aunettes', null, 2),
(1, null, 'Avenue Geoffroy Saint-Hilaire', null, 5),
(50, null, 'Rue des Lys', null, 5),
(23, null, 'Rue du sable', null, 3),
(12, null, 'Rue de la liberté', null, 4),
(67, null, 'Avenue George', null, 7),
(9, null, 'Boulevard de la seine', null, 1),
(15, null, 'Chemin des roses', null, 2),
(25, null, 'Rue des Lilas', null, 10),
(12, null, 'Avenue du Soleil', null, 11),
(8, null, 'Rue de la Mer', null, 12),
(45, null, 'Chemin des Chênes', null, 13),
(3, null,'Rue Nappoléon', null, 14),
(18, null, 'Rue de la Rivière', 'Laisser dans la boîte aux lettres', 16),
(5, null, 'Avenue des Roses', 'Appeler en bas du bâtiment', 17),
(32, null, 'Rue du Mont Blanc', 'Appartement 12', 18),
(14, null, 'Rue de la Seine', 'Appler avec l interphone l appertement 54', 11),
(7, null, 'Rue des Oliviers', 'Etage 5, Appartement 4, code 458A', 18);

-- Insérer les livreurs --
INSERT INTO LIVREUR (DisponibiliteLivreur, SalaireLivreur, Capacite, IndividuLivreur) VALUES
('En cours de mission', 1200, 2, 16),
('En cours de mission', 1250, 2, 17),
('Disponible', 1300, 2, 18),
('Indisponible', 1350, 2, 19),
('Indisponible', 1400, 3, 20),
('Disponible', 1450, 3, 21),
('En cours de mission', 1500, 3, 22),
('Disponible', 1550, 3, 23),
('Disponible', 1600, 4, 24);

-- Insertions des pizzaiolos --
INSERT INTO PIZZAIOLO (DisponibilitePizzaiolo, SalairePizzaiolo, IndividuPizzaiolo) VALUES
('Disponible', 2200, 25),
('Indisponible', 2200, 1),
('En cuisine', 1950, 26);

-- Insertion des gestionnaires --
INSERT INTO GESTIONNAIRE (SalaireGestionnaire, IndividuGestionnaire) VALUES
(2345, 27),
(1890, 28);

-- Insertion des fournisseurs --
INSERT INTO FOURNISSEUR (NomFournisseur, TelephoneFournisseur, EmailFournisseur, AdresseFournisseur) VALUES
('Saveurs d Italie', '01.02.65.32.22', 'Saveurs@email.com', 16),
('FraîcheurCulin Air', '01.54.85.96.57', 'Culin@email.com', 17),
('Bio Prod', '01.65.24.21.55', 'bioprod@email.com', 18),
('Marché de famille', '05.68.32.59.21', 'marchefamille@email.com', 19),
('Philipe Bozin', '01.54.52.36.95', 'philipe.bozin@email.com', 20),
('Miam', '01.25.85.62.42', null, 21),
('Béatrice Polu', '05.24.98.75.35', null, 22),
('Boucherie Fort', '05.41.98.62.35', null, 23),
('L.J.K.', null, 'ljk@email.com', 24),
('Fav', null, 'fav@email.com', 25);

-- Insertion des clients --
INSERT INTO CLIENT (IndividuClient, AdresseClient) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(27, 5),
(24, 8);

-- Insertions des pizzas --
INSERT INTO PIZZA (NomPizza, DescriptionPizza, Theme, AjoutGestionnaire) VALUES
('Margherita', 'Une base de sauce tomate, de la mozzarella fraîche, des tomates cerises et du basilic frais, cette pizza simple et délicieuse est un classique italien.', 'Ete', 1),
('Pepperoni', 'Une généreuse couche de pepperoni tranché, de la sauce tomate épicée et une abondance de fromage mozzarella font de cette pizza une option savoureuse pour les amateurs de viande.', 'Automne', 1),
('Végétarienne', 'Une croûte garnie de sauce pesto, de feta, d''olives Kalamata, de tomates séchées au soleil, de poivrons grillés et d''épinards frais, cette pizza méditerranéenne est une explosion de saveurs végétariennes.', 'Printemps', 1),
('Quatre fromages', 'Un mélange exquis de fromages comprenant la mozzarella, le gorgonzola, le brie et le parmesan, cette pizza ravira les amateurs de fromage avec sa richesse et sa variété.', 'Hiver', 1),
('BBQ chicken', 'Du poulet grillé mariné dans une sauce barbecue, du bacon croustillant, de la mozzarella et une touche de sauce ranch crémeuse font de cette pizza une expérience gustative unique.', 'Printemps', 2),
('Hawaienne', 'L''alliance sucrée et salée avec du jambon, de l''ananas frais, de la sauce tomate et du fromage mozzarella crée une pizza hawaïenne délectable.', 'Ete', 2),
('Méditerranéenne', 'Des fruits de mer tels que des crevettes, des moules et des calmars, associés à une sauce tomate aux herbes et à l''ail, font de cette pizza une expérience méditerranéenne riche en saveurs marines.', 'Ete', 2),
('Pesto', 'Une base de sauce pesto, du poulet grillé, des artichauts marinés et du fromage mozzarella se combinent pour créer une pizza délicieusement différente.', 'Automne', 1),
('Capricciosa', 'Une combinaison classique de jambon cuit, de champignons frais, d''olives noires et de sauce tomate, cette pizza italienne traditionnelle est un choix sûr pour les amateurs de saveurs simples et authentiques.', 'Hiver', 2),
('Margarita burrata', 'Une variante luxueuse de la Margherita classique, cette pizza est garnie de tomates fraîches, de basilic, de mozzarella de burrata crémeuse et d''un filet d''huile d''olive extra vierge pour une expérience gastronomique.', 'Hiver', 1);

-- Insertion des allergènes --
INSERT INTO ALLERGENE (NomAllergene, ResponsableAjoutAllergene) VALUES
('Gluten', 1),
('Crustacés', 2),
('Oeufs', 2),
('Arachides', 2),
('Poissons', 2),
('Soja', 2),
('Lait', 2),
('Fruits à coque', 2),
('Céleri', 2),
('Moutarde', 1),
('Sésame', 1),
('Sulfites', 2),
('Lupin', 1),
('Mollusques', 1);

-- Insertion des statistiques --
INSERT INTO STATISTIQUE (idStatistique, ChiffreDAffairesMensuel, ChiffreDAffairesHebdomadaire, ChiffreDAffairesJournalier, ResponsableAjoutStatistique) VALUES
(2022, 10080, 840, 120, 1),
(2023, 10920, 910, 130, 2);

-- Insertion des commandes --
INSERT INTO COMMANDE (DateCommande, StatutCommande, PaiementCommande, ClientCommande) VALUES
(CURDATE(), 'En cours de livraison', 1, 1),
(CURDATE(), 'En cours de livraison', 2, 2),
(CURDATE(), 'En cours de livraison', 3, 3),
(CURDATE(), 'En cours de livraison', 4, 4),
(CURDATE(), 'En cours de livraison', 5, 5),
(CURDATE(), 'En cours de livraison', 6, 6),
(CURDATE(), 'En cours de livraison', 7, 7),
(CURDATE(), 'En cours de livraison', 8, 8),
(CURDATE(), 'Validée', 9, 9),
(CURDATE(), 'En préparation', 10, 10),
(CURDATE(), 'Prête pour livraison', 1, 17),
(CURDATE(), 'En cours', null, 15),
('2022-07-08', 'Livrée', null, 1),
('2022-10-30', 'Livrée', null, 2),
('2022-03-21', 'Livrée', null, 3),
('2022-04-01', 'Livrée', null, 4),
('2022-12-31', 'Livrée', null, 1),
('2022-01-10', 'Livrée', null, 5),
('2022-03-15', 'Livrée', null, 6),
('2022-03-21', 'Livrée', null, 7),
('2022-05-21', 'Livrée', null, 8),
('2022-06-17', 'Livrée', null, 2),
('2022-08-15', 'Livrée', null, 9),
('2022-11-18', 'Livrée', null, 7),
('2022-12-24', 'Livrée', null, 10),
('2022-12-18', 'Livrée', null, 11),
('2023-01-01', 'Livrée', null, 12),
('2023-01-01', 'Livrée', null, 13),
('2023-02-14', 'Livrée', null, 14),
('2023-05-11', 'Livrée', null, 15),
('2023-05-21', 'Livrée', null, 11),
('2023-07-08', 'Livrée', null, 16),
('2023-10-05', 'Livrée', null, 17);

-- Insertion du lien entre pizza et ingrédients --
INSERT INTO compose_de (RecettePizza, IngredientNecessaire, QuantiteDeIngredient) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 1),
(2, 4, 4),
(2, 2, 3),
(2, 3, 2),
(3, 5, 3),
(3, 6, 3),
(3, 7, 3),
(3, 2, 2),
(3, 3, 2),
(4, 3, 2),
(4, 8, 1),
(4, 9, 1),
(4, 10, 1),
(5, 11, 1),
(5, 12, 1),
(5, 2, 2),
(5, 3, 2),
(6, 13, 2),
(6, 14, 1),
(6, 2, 2),
(6, 3, 1),
(7, 7, 3),
(7, 2, 2),
(7, 6, 2),
(7, 1, 2),
(7, 3, 2),
(8, 15, 2),
(8, 2, 2),
(8, 3, 2),
(9, 5, 3),
(9, 13, 2),
(9, 7, 3),
(9, 2, 2),
(9, 3, 2),
(10, 16, 2),
(10, 1, 2),
(10, 2, 2),
(10, 3, 2);

-- Insertions des allergies --
INSERT INTO est_allergique (ClientAllergique, AllergieDuClient) VALUES
(1, 5),
(1, 14),
(1, 2),
(2, 1),
(2, 6),
(3, 7),
(6, 9),
(7, 12),
(9, 8);

-- Insertion des produits commandés --
INSERT INTO commande_produit (ProduitCommande, CommandeFait, QuantiteProduit) VALUES
(1, 13, 1),
(4, 13, 1),
(9, 15, 3),
(8, 18, 1),
(6, 20, 4),
(7, 25, 1),
(1, 33, 8),
(1, 1, 1),
(6, 1, 1),
(7, 1, 1),
(3, 2, 2),
(7, 5, 1),
(9, 6, 2),
(4, 7, 1),
(6, 7, 1),
(4, 8, 1),
(1, 9, 1),
(4, 11, 2);

-- Insertion des commandes à livrer --
INSERT INTO livre (CommandeALivre, LivreurCharge) VALUES
(13, 1),
(14, 1),
(15, 1),
(16, 6),
(17, 7),
(18, 2),
(19, 4),
(20, 2),
(21, 2),
(22, 5),
(23, 2),
(24, 1),
(25, 1),
(26, 3),
(27, 4),
(28, 5),
(29, 1),
(30, 3),
(31, 3),
(32, 6),
(33, 6),
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 1),
(7, 3),
(8, 7);

-- Insertion des commandes à cuisiner --
INSERT INTO cuisine (CommandeEmise, Preparateur) VALUES
(13, 1),
(14, 1),
(15, 1),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 3),
(23, 2),
(24, 3),
(25, 3),
(26, 3),
(27, 1),
(28, 2),
(29, 1),
(30, 3),
(31, 3),
(32, 1),
(33, 3),
(1, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(10, 2),
(11, 1);

-- Insertion des allergènes contenuent dans des pizzas --
INSERT INTO possede (PizzaAvecAllergene, AllergeneContenu) VALUES
(1, 1),
(3, 6),
(5, 10),
(6, 8),
(7, 2),
(7, 5);

-- Insertion des allergène contenuent dans les produits --
INSERT INTO contient (ProduitAvecAllergene, AllergeneImplique) VALUES
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(7, 8);

-- Insertion du lien entre les ingrédients et leur fournisseur -- 
INSERT INTO est_fournit (IngredientRecherche, FournisseurDeIngredient) VALUES
(1, 1),
(2, 3),
(3, 5),
(4, 7),
(5, 9),
(6, 2),
(7, 4),
(8, 6),
(9, 8),
(10, 10),
(11, 1),
(12, 3),
(13, 5),
(14, 7),
(15, 9),
(16, 2),
(17, 4),
(18, 6),
(19, 8),
(20, 10);

-- Insertion du lien entre les produits et leur fournisseur --
INSERT INTO provient (ProduitRecherche, FournisseurDuProduit) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10);

-- Insertions des bon d'achats --
INSERT INTO bon_d_achat (Beneficiaire, Raison, Utilise) VALUES
(1, 1, TRUE),
(2, 1, TRUE),
(3, 1, FALSE),
(7, 4, FALSE),
(9, 2, FALSE),
(15, 3, FALSE);

-- Insertion des pizzas commandés --
INSERT INTO commande_pizza (PizzaCommande, CommandeEffectue, QuantitePizza, CommentairePizza, StatutPizza) VALUES
(1, 13, 2, null, 'Terminée'),
(10, 13, 1, null, 'Terminée'),
(2, 14, 1, null, 'Terminée'),
(3, 14, 1, null, 'Terminée'),
(1, 15, 3, null, 'Terminée'),
(10, 16, 2, null, 'Terminée'),
(5, 17, 1, null, 'Terminée'),
(10, 17, 1, null, 'Terminée'),
(8, 17, 1, null, 'Terminée'),
(5, 18, 1, null, 'Terminée'),
(9, 19, 2, null, 'Terminée'),
(3, 20, 1, null, 'Terminée'),
(6, 21, 5, null, 'Terminée'),
(1, 22, 3, null, 'Terminée'),
(4, 23, 1, null, 'Terminée'),
(8, 24, 1, null, 'Terminée'),
(9, 25, 1, null, 'Terminée'),
(10, 26, 3, null, 'Terminée'),
(6, 27, 1, null, 'Terminée'),
(6, 28, 2, null, 'Terminée'),
(10, 28, 1, null, 'Terminée'),
(10, 29, 5, null, 'Terminée'),
(10, 30, 2, null, 'Terminée'),
(10, 31, 1, null, 'Terminée'),
(4, 32, 3, null, 'Terminée'),
(5, 33, 1, null, 'Terminée'),
(10, 1, 1, null, 'Terminée'),
(5, 1, 2, null, 'Terminée'),
(6, 2, 10, null, 'Terminée'),
(9, 4, 1, null, 'Terminée'),
(10, 5, 1, null, 'Terminée'),
(1, 5, 1, null, 'Terminée'),
(10, 6, 1, null, 'Terminée'),
(1, 7, 4, null, 'Terminée'),
(2, 8, 3, null, 'Terminée'),
(1, 8, 3, null, 'Terminée'),
(10, 9, 3, 'Merci de mettre rajouté les tomates après la cuisson.', 'En attente'),
(8, 10, 1, null, 'En cours de préparation'),
(1, 11, 1, null, 'Terminée');