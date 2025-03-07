-- fana 

-- les views 

 -- view des commande en preparation (fanatitra rakotomavo) 
 

CREATE OR REPLACE VIEW VCommandeEnPreparation AS
SELECT COMMANDE.numCommande, COMMANDE.DateCommande, COMMANDE.StatutCommande
FROM COMMANDE
WHERE COMMANDE.StatutCommande = 'En préparation';



-- view des commandes en cours de livraison  (fanatitra rakotomavo)

CREATE OR REPLACE VIEW VCommandeEnLivraison AS
SELECT COMMANDE.numCommande, COMMANDE.DateCommande, COMMANDE.StatutCommande
FROM COMMANDE
INNER JOIN livre ON livre.CommandeALivre = COMMANDE.numCommande
INNER JOIN LIVREUR ON LIVREUR.idLivreur = livre.LivreurCharge
WHERE LIVREUR.DisponibiliteLivreur = "En cours de mission";



-- veiw d'affichages des pizza (ordonné par thème) (fanatitra rakotomavo)

CREATE OR REPLACE VIEW VPizzaGroup AS
SELECT PIZ.NomPizza, PIZ.DescriptionPizza, PIZ.Theme, PIZ.PrixPizza
    FROM PIZZA PIZ
    ORDER BY PIZ.Theme ;




-- view des commandes (fanatitra rakotomavo)

CREATE OR REPLACE VIEW VCommande AS

select COMMANDE.numCommande, COMMANDE.DateCommande, COMMANDE.StatutCommande	
FROM COMMANDE

































