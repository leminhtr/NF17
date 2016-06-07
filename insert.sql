BEGIN TRANSACTION;

INSERT INTO Competences (nom, langue) VALUES ('Sport','FR');
INSERT INTO Competences (nom, langue) VALUES ('Sport','EN');
INSERT INTO Competences (nom, langue) VALUES ('database','EN');
INSERT INTO competences (nom, langue) VALUES ('base de donnée','FR');
INSERT INTO competences (nom, langue) VALUES ('SQL','FR');
INSERT INTO competences (nom, langue) VALUES ('SQL','EN');

INSERT INTO Domaines_Etudes (DE_fr, DE_en) VALUES ('Informatique','Computer sciences');
INSERT INTO Domaines_Etudes (DE_fr, DE_en) VALUES ('Biologie','Biology');
INSERT INTO Domaines_Etudes (DE_fr, DE_en) VALUES ('Mécanique','Mechanic');



INSERT INTO Formations (date_debut, date_fin, etablissement,pays, ville, domaine_etude) VALUES ('2010-06-21','2012-06-21','UTC','France','Compiègne',1);
INSERT INTO Formations (date_debut, date_fin, etablissement, domaine_etude) VALUES ('2010-02-10','2012-02-10','UTC',2);
INSERT INTO Formations (date_debut, date_fin, etablissement, domaine_etude) VALUES ('2010-06-23','2013-06-21','UTC',2);
INSERT INTO Formations (date_debut, date_fin, etablissement, domaine_etude) VALUES ('2010-06-23','2012-06-21','UTC',1);
INSERT INTO Formations (date_debut, date_fin, etablissement, domaine_etude) VALUES ('2010-06-23','2015-06-21','UTC',3);
UPDATE formations SET ville='Compiègne' where id_formation=3;
UPDATE formations SET ville='Compiègne' where id_formation=2;
UPDATE formations SET ville='Compiègne' where id_formation=4;
UPDATE formations SET ville='Compiègne' where id_formation=5;
UPDATE formations SET pays='France' where id_formation=2;
UPDATE formations SET pays='France' where id_formation=3;
UPDATE formations SET pays='France' where id_formation=4;
UPDATE formations SET pays='France' where id_formation=5;


INSERT INTO Formations (date_debut, date_fin, etablissement,pays, ville, domaine_etude) VALUES ('2010-06-21','2012-07-21','UTC','France','Compiègne',1);
INSERT INTO Formations (date_debut, date_fin, etablissement, domaine_etude) VALUES ('2010-02-10','2012-02-15','UTC',2);
INSERT INTO Formations (date_debut, date_fin, etablissement, domaine_etude) VALUES ('2010-06-23','2013-06-01','UTC',2);



INSERT INTO Formations_Traduites (titre, type, langue, id_formation) VALUES ('Je_comprends pas','bah_rien','EN',3);
INSERT INTO Formations_Traduites (titre, type, langue, id_formation) VALUES ('Diplôme ingénieur','Master','FR',3);
INSERT INTO Formations_Traduites (titre, type, langue, id_formation) VALUES ('Diplôme ingénieur Informatique SRI','Master','FR',4);
INSERT INTO Formations_Traduites (titre, type, langue, id_formation) VALUES ('Engineer diploma computer science SRI','Master','EN',4);
INSERT INTO Formations_Traduites (titre, type, langue, id_formation) VALUES ('Diplôme ingénieur Mécanique','Master','FR',5);
INSERT INTO Formations_Traduites (titre, type, langue, id_formation) VALUES ('Engineer diploma mechanic','Master','EN',5);

COMMIT;
BEGIN TRANSACTION;

INSERT INTO Secteurs_Activites (SA_fr, SA_en) VALUES ('Automobile','Automabil');
INSERT INTO Secteurs_Activites (SA_fr, SA_en) VALUES ('Restauration','Restaurant');
INSERT INTO Secteurs_Activites (SA_fr, SA_en) VALUES ('Service','Service');

INSERT INTO SecteurEntreprise (nom_entreprise, secteur_activite) VALUES ('Renaud',1);
INSERT INTO SecteurEntreprise (nom_entreprise, secteur_activite) VALUES ('Peugot',1);
INSERT INTO SecteurEntreprise (nom_entreprise, secteur_activite) VALUES ('Buffalo Grill',2);
INSERT INTO SecteurEntreprise (nom_entreprise, secteur_activite) VALUES ('Google',3);
INSERT INTO SecteurEntreprise (nom_entreprise, secteur_activite) VALUES ('IBM',3);

INSERT INTO Experiences_Pro (nom_entreprise, date_debut, date_fin) VALUES ('Renaud','2013-06-21','2015-06-21');
INSERT INTO Experiences_Pro (nom_entreprise, date_debut, date_fin) VALUES ('Peugot','2014-06-21','2015-06-21');
INSERT INTO Experiences_Pro (nom_entreprise, date_debut, date_fin) VALUES ('Peugot','2012-06-21','2015-06-21');
INSERT INTO Experiences_Pro (nom_entreprise, date_debut, date_fin) VALUES ('Google','2000-01-01','2001-06-21');
INSERT INTO Experiences_Pro (nom_entreprise, date_debut, date_fin) VALUES ('Buffalo Grill','2003-01-01','2008-06-21');
INSERT INTO Experiences_Pro (nom_entreprise, date_debut, date_fin) VALUES ('IBM','2003-01-01','2005-06-21');

INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES (1,'ingénieur','FR');
INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES (1,'engineer','EN');
INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES (2,'RH','FR');
INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES (4,'Ouvrier','FR');
INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES (4,'Worker','EN');
INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES (5,'Serveur','FR');
INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES (5,'Waiter','EN');


COMMIT;
BEGIN TRANSACTION;

INSERT INTO Status (statut_fr, statut_en) VALUES ('President','President');
INSERT INTO Status (statut_fr, statut_en) VALUES ('Vice-President','Vice-President');
INSERT INTO Status (statut_fr, statut_en) VALUES ('Responsable Logistique','Logistic Responsable');
INSERT INTO Status (statut_fr, statut_en) VALUES ('Responsable Communication','Communication Responsable');
INSERT INTO Status (statut_fr, statut_en) VALUES ('Responsable Son&Lumière','Sound and light Responsable');

INSERT INTO Postes_Associations (nom_asso, date_debut, date_fin, statut) VALUES ('Festupic','2012-06-23','2013-06-21',3);

COMMIT;
BEGIN TRANSACTION;


INSERT INTO Langues (nom_fr, nom_en) VALUES ('Francais','French');
INSERT INTO Langues (nom_fr, nom_en) VALUES ('Angais','English');
INSERT INTO Langues (nom_fr, nom_en) VALUES ('Espagnol','Spanish');
INSERT INTO Langues (nom_fr, nom_en) VALUES ('Allemand','German');

COMMIT;
BEGIN TRANSACTION;

INSERT INTO DatePublication (ISBN, date) VALUES ('isbn1','2012-06-23');

INSERT INTO Publications (titre, id_date_pub, contenu) VALUES ('publication',1,'blablabla');

COMMIT;
BEGIN TRANSACTION;

INSERT INTO Individus (nom, prenom, mail) VALUES ('Legeron','Camille','clegeron@etu.utc.fr');
INSERT INTO Individus (nom, prenom, mail) VALUES ('Tong','Chen','chentong@etu.utc.fr');
INSERT INTO Individus (nom, prenom, mail) VALUES ('Edesseau','Eumael','edesseau@etu.utc.fr');
INSERT INTO Individus (nom, prenom, mail) VALUES ('Le','Minh Tri','minh-tri.le@etu.utc.fr');
INSERT INTO Individus (nom, prenom, mail) VALUES ('Candidat1','winner','zoulou@etu.utc.fr');
INSERT INTO Individus (nom, prenom, mail) VALUES ('Candidat2','winner','candidat2@etu.utc.fr');
INSERT INTO Individus (nom, prenom, mail) VALUES ('Candidat3','winner','candidat3@etu.utc.fr');
INSERT INTO Individus (nom, prenom, mail) VALUES ('Lussier','Benjamin','b.lussier@utc.fr');
INSERT INTO Individus (nom, prenom, mail) VALUES ('New','Guy','new_guy@utc.fr');
INSERT INTO Individus (nom, prenom, mail) VALUES ('New','Fellow','new_fellow@utc.fr');


INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type, url_web) VALUES (5, 'zoulou','zoulou', '0654852635','portable','https://google.fr');
UPDATE Candidats SET url_web='https://google.fr' where id_candidat=5;


INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type) VALUES (6, 'minhtrile','minhtrile', '0654852637','portable');
INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type) VALUES (7, 'camille','camille', '0654852638','portable');


INSERT INTO Referents (id_referent, situation_pro, employeur) VALUES (1,'eleveNF17','Benjamin Lussier');
INSERT INTO Referents (id_referent, situation_pro, employeur) VALUES (2,'eleveNF17','Benjamin Lussier');
INSERT INTO Referents (id_referent, situation_pro, employeur) VALUES (3,'eleveNF17','Benjamin Lussier');
INSERT INTO Referents (id_referent, situation_pro, employeur) VALUES (4,'eleveNF17','Benjamin Lussier');
INSERT INTO Referents (id_referent, situation_pro, employeur) VALUES (8,'Professeur','UTC');



COMMIT;
BEGIN TRANSACTION;


INSERT INTO CV (candidat, statut, date_creation, date_maj) VALUES (5,'active','2012-06-23','2012-06-23');
INSERT INTO CV (candidat, statut, date_creation, date_maj) VALUES (7,'confidentiel','2012-06-22',current_date);
INSERT INTO CV (candidat, statut, date_creation, date_maj) VALUES (6,'desactive','2012-06-21',current_date);

INSERT INTO CV_traduit (id_CV, langue, titre) VALUES (1,'FR','Recherche de stage');
INSERT INTO CV_traduit (id_CV, langue, titre) VALUES (1,'EN','Searching for a job');


INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES (5,'Sport','FR');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES (5,'Sport','EN');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES (5,'SQL','FR');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES (5,'base de donnée','FR');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES (7,'base de donnée','FR');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES (6,'base de donnée','FR');

INSERT INTO Suivre_Formation (id_candidat, id_formation) VALUES (5,1);
INSERT INTO Suivre_Formation (id_candidat, id_formation) VALUES (5,2);
INSERT INTO Suivre_Formation (id_candidat, id_formation) VALUES (5,3);


INSERT INTO Avoir_Experience (id_candidat, id_exp_pro) VALUES (5,1);
INSERT INTO Avoir_Experience (id_candidat, id_exp_pro) VALUES (5,2);
INSERT INTO Avoir_Experience (id_candidat, id_exp_pro) VALUES (5,3);


INSERT INTO Participer_Association (id_candidat, id_asso) VALUES (5,1);

INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES (5,1,'C2');
INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES (5,2,'B2');
INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES (5,3,'B1');



INSERT INTO Posseder_Referent (id_candidat, id_referent) VALUES (5,1);
INSERT INTO Posseder_Referent (id_candidat, id_referent) VALUES (5,8);
INSERT INTO Posseder_Referent (id_candidat, id_referent) VALUES (6,8);
INSERT INTO Posseder_Referent (id_candidat, id_referent) VALUES (7,8);




COMMIT;


