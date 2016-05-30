BEGIN TRANSACTION;

INSERT INTO Competences (nom, langue) VALUES ('Sport','FR');
INSERT INTO Competences (nom, langue) VALUES ('Sport','EN');
INSERT INTO Competences (nom, langue) VALUES ('database','EN');
INSERT INTO competences (nom, langue) VALUES ('base de donnée','FR');
INSERT INTO competences (nom, langue) VALUES ('SQL','FR');
INSERT INTO competences (nom, langue) VALUES ('SQL','EN');

INSERT INTO Domaines_Etudes (id_DE, DE_fr, DE_en) VALUES ('1','Informatique','Computer sciences');
INSERT INTO Domaines_Etudes (id_DE, DE_fr, DE_en) VALUES ('2','Biologie','Biology');


INSERT INTO Formations (id_formation, date_debut, date_fin, etablissement,pays, ville, domaine_etude) VALUES ('1','2010-06-21','2012-06-21','UTC','France','Compiègne','1');
INSERT INTO Formations (id_formation, date_debut, date_fin, etablissement, domaine_etude) VALUES ('2','2010-02-10','2012-02-10','UTC','2');
INSERT INTO Formations (id_formation, date_debut, date_fin, etablissement, domaine_etude) VALUES ('3','2010-06-23','2013-06-21','UTC','2');


INSERT INTO Formations_Traduites (titre, type, langue, id_formation) VALUES ('Je_comprends pas','bah_rien','EN','3');
INSERT INTO Formations_Traduites (titre, type, langue, id_formation) VALUES ('Diplôme ingénieur','Master','FR','3');

COMMIT;
BEGIN TRANSACTION;

INSERT INTO Secteurs_Activites (id_SA, SA_fr, SA_en) VALUES ('1','Automobile','Automabil');
INSERT INTO Secteurs_Activites (id_SA, SA_fr, SA_en) VALUES ('2','Restauration','Restaurant');

INSERT INTO SecteurEntreprise (id_SE, nom_entreprise, secteur_activite) VALUES ('1','Renaud','1');
INSERT INTO SecteurEntreprise (id_SE, nom_entreprise, secteur_activite) VALUES ('2','Peugot','1');
INSERT INTO SecteurEntreprise (id_SE, nom_entreprise, secteur_activite) VALUES ('3','Buffalo Grill','2');

INSERT INTO Experiences_Pro (id_exp_pro, nom_entreprise, date_debut, date_fin) VALUES ('1','Renaud','2013-06-21','2015-06-21');
INSERT INTO Experiences_Pro (id_exp_pro, nom_entreprise, date_debut, date_fin) VALUES ('2','Peugot','2014-06-21','2015-06-21');
INSERT INTO Experiences_Pro (id_exp_pro, nom_entreprise, date_debut, date_fin) VALUES ('3','Peugot','2012-06-21','2015-06-21');

INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES ('1','ingénieur','FR');
INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES ('1','engineer','EN');
INSERT INTO experiences_pro_traduites (id_exp_pro, fonction, langue) VALUES ('2','RH','FR');

COMMIT;
BEGIN TRANSACTION;

INSERT INTO Status (id_statut, statut_fr, statut_en) VALUES ('1','President','President');
INSERT INTO Status (id_statut, statut_fr, statut_en) VALUES ('2','Vice-President','Vice-President');
INSERT INTO Status (id_statut, statut_fr, statut_en) VALUES ('3','Responsable Logistique','Logistic Responsable');
INSERT INTO Status (id_statut, statut_fr, statut_en) VALUES ('4','Responsable Communication','Communication Responsable');
INSERT INTO Status (id_statut, statut_fr, statut_en) VALUES ('5','Responsable Son&Lumière','Sound and light Responsable');

INSERT INTO Postes_Associations (id_asso, nom_asso, date_debut, date_fin, statut) VALUES ('1','Festupic','2012-06-23','2013-06-21','3');

COMMIT;
BEGIN TRANSACTION;


INSERT INTO Langues (id, nom_fr, nom_en) VALUES ('1','Francais','French');
INSERT INTO Langues (id, nom_fr, nom_en) VALUES ('2','Angais','English');
INSERT INTO Langues (id, nom_fr, nom_en) VALUES ('3','Espagnol','Spanish');
INSERT INTO Langues (id, nom_fr, nom_en) VALUES ('4','Allemand','German');

COMMIT;
BEGIN TRANSACTION;

INSERT INTO DatePublication (id_date_pub, ISBN, date) VALUES ('1','isbn1','2012-06-23');

INSERT INTO Publications (id_pub, titre, id_date_pub, contenu) VALUES ('1','publication','1','blablabla');

COMMIT;
BEGIN TRANSACTION;

INSERT INTO Individus (id_individu, nom, prenom, mail) VALUES ('1','Legeron','Camille','clegeron@etu.utc.fr');
INSERT INTO Individus (id_individu, nom, prenom, mail) VALUES ('2','Tong','Chen','chentong@etu.utc.fr');
INSERT INTO Individus (id_individu, nom, prenom, mail) VALUES ('3','Edesseau','Eumael','edesseau@etu.utc.fr');
INSERT INTO Individus (id_individu, nom, prenom, mail) VALUES ('4','Le','Minh Tri','minh-tri.le@etu.utc.fr');
INSERT INTO Individus (id_individu, nom, prenom, mail) VALUES ('5','Candidat1','winner','zoulou@etu.utc.fr');
INSERT INTO Individus (id_individu, nom, prenom, mail) VALUES ('6','Candidat2','winner','candidat2@etu.utc.fr');
INSERT INTO Individus (id_individu, nom, prenom, mail) VALUES ('7','Candidat3','winner','candidat3@etu.utc.fr');


INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type, url_web) VALUES ('5', 'zoulou','zoulou', '0654852635','portable','https://google.fr');
UPDATE Candidats SET url_web='https://google.fr' where id_candidat='5';


INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type) VALUES ('6', 'minhtrile','minhtrile', '0654852637','portable');
INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type) VALUES ('7', 'camille','camille', '0654852638','portable');

INSERT INTO Referents (id_referent, situation_pro, employeur) VALUES ('1','eleveNF17','Benjamin Lussier');
INSERT INTO Referents (id_referent, situation_pro, employeur) VALUES ('2','eleveNF17','Benjamin Lussier');
INSERT INTO Referents (id_referent, situation_pro, employeur) VALUES ('3','eleveNF17','Benjamin Lussier');
INSERT INTO Referents (id_referent, situation_pro, employeur) VALUES ('4','eleveNF17','Benjamin Lussier');



COMMIT;
BEGIN TRANSACTION;


INSERT INTO CV (id_CV, candidat, statut, date_creation, date_maj) VALUES ('1', '5','active','2012-06-23','2012-06-23');
INSERT INTO CV (id_CV, candidat, statut, date_creation, date_maj) VALUES ('2', '7','confidentiel','2012-06-22',current_date);
INSERT INTO CV (id_CV, candidat, statut, date_creation, date_maj) VALUES ('3', '6','desactive','2012-06-21',current_date);

INSERT INTO CV_traduit (id_CV, langue, titre) VALUES ('1','FR','Recherche de stage');
INSERT INTO CV_traduit (id_CV, langue, titre) VALUES ('1','EN','Searching for a job');


INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES ('5','Sport','FR');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES ('5','Sport','EN');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES ('5','SQL','FR');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES ('5','base de donnée','FR');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES ('7','base de donnée','FR');
INSERT INTO Posseder_Competence (id_candidat, nom, langue) VALUES ('6','base de donnée','FR');

INSERT INTO Suivre_Formation (id_candidat, id_formation) VALUES ('5','1');
INSERT INTO Suivre_Formation (id_candidat, id_formation) VALUES ('5','2');
INSERT INTO Suivre_Formation (id_candidat, id_formation) VALUES ('5','3');

INSERT INTO Avoir_Experience (id_candidat, id_exp_pro) VALUES ('5','1');
INSERT INTO Avoir_Experience (id_candidat, id_exp_pro) VALUES ('5','2');
INSERT INTO Avoir_Experience (id_candidat, id_exp_pro) VALUES ('5','3');

INSERT INTO Participer_Association (id_candidat, id_asso) VALUES ('5','1');

INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES ('5','1','C2');
INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES ('5','2','B2');
INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES ('5','3','B1');

INSERT INTO Posseder_Referent (id_candidat, id_referent) VALUES ('5','1');




COMMIT;


