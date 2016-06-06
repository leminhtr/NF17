BEGIN TRANSACTION;

CREATE TYPE LANGUE AS ENUM ('EN','FR');  /*ENUM type Langue*/

CREATE TABLE Competences (
            nom VARCHAR(50),
            langue LANGUE,
            PRIMARY KEY (nom, langue)
);

CREATE TABLE Domaines_Etudes (
	id_DE SERIAL PRIMARY KEY,
	DE_fr VARCHAR(50) UNIQUE NOT NULL,
	DE_en VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE Formations (
	id_formation SERIAL PRIMARY KEY,
	date_debut DATE NOT NULL,
	date_fin DATE NOT NULL,
	etablissement VARCHAR(100) NOT NULL,
	pays VARCHAR(50),
	ville VARCHAR(50),
	domaine_etude INTEGER REFERENCES Domaines_Etudes(id_DE),
	UNIQUE (date_debut, date_fin, etablissement)
);

CREATE TABLE Formations_Traduites(
	titre VARCHAR(50),
	type VARCHAR(50),
	langue LANGUE,
	id_formation INTEGER REFERENCES Formations(id_formation),
	PRIMARY KEY (titre, type, langue, id_formation)
);

CREATE TABLE Secteurs_Activites (
	id_SA SERIAL PRIMARY KEY,
	SA_fr VARCHAR (50) UNIQUE NOT NULL,
	SA_en VARCHAR (50) UNIQUE NOT NULL
);

CREATE TABLE SecteurEntreprise(
	id_SE SERIAL PRIMARY KEY,
	nom_entreprise VARCHAR(50) UNIQUE NOT NULL,
	secteur_activite INTEGER REFERENCES Secteurs_activites(id_SA)
);

CREATE TABLE Experiences_Pro(
	id_exp_pro SERIAL PRIMARY KEY,
	nom_entreprise VARCHAR (50) REFERENCES SecteurEntreprise(nom_entreprise),
	date_debut DATE NOT NULL,
	date_fin DATE NOT NULL,
	UNIQUE (nom_entreprise, date_debut, date_fin)
);

CREATE TABLE Experiences_Pro_Traduites (
	id_exp_pro SERIAL REFERENCES Experiences_Pro(id_exp_pro),
	fonction VARCHAR(50),
	langue LANGUE,
	PRIMARY KEY (id_exp_pro, fonction, langue)
);



/*Package Poste Associations (3 tables)*/

CREATE TABLE Status(
      id_statut SERIAL PRIMARY KEY,
      statut_fr VARCHAR(50) NOT NULL,
      statut_en VARCHAR(50) NOT NULL,
      UNIQUE (statut_fr,statut_en)  /*(statut_fr,statut_en) clé candidate*/
);

CREATE TABLE Postes_Associations(
      id_asso SERIAL PRIMARY KEY,
      nom_asso VARCHAR(100) NOT NULL,
      date_debut DATE NOT NULL,
      date_fin DATE NOT NULL,
      statut INTEGER REFERENCES Status(id_statut),
      UNIQUE (nom_asso,date_debut,date_fin) /*(nom_asso,date_debut,date_fin) clé candidate*/
);

CREATE TABLE Postes_Associations_Traduits(
      id_asso INTEGER REFERENCES Postes_Associations(id_asso),
      langue LANGUE,
      description TEXT,
      PRIMARY KEY (id_asso,description,langue)
);

/*Package Langues*/

CREATE TABLE Langues(
      id SERIAL PRIMARY KEY,
      nom_fr VARCHAR(50) UNIQUE NOT NULL, /*clé candidate*/
      nom_en VARCHAR(50) UNIQUE NOT NULL /*clé candidate*/      
);

/*Package Candidat, CV et autres classes hors packages*/

CREATE TABLE DatePublication(
	id_date_pub SERIAL PRIMARY KEY,
	ISBN  VARCHAR(20) UNIQUE NOT NULL,
	date DATE
);

CREATE TABLE Publications(
	id_pub SERIAL PRIMARY KEY,
	titre VARCHAR (100) NOT NULL,
	id_date_pub INTEGER REFERENCES DatePublication(id_date_pub),
	contenu TEXT NOT NULL, /*mini-résumé*/
	UNIQUE (titre, id_date_pub)
);

CREATE TABLE Individus(
      id_individu SERIAL PRIMARY KEY,
      nom VARCHAR(60) NOT NULL,
      prenom VARCHAR(60) NOT NULL,
      mail VARCHAR(100) UNIQUE NOT NULL   /*clé candidate*/
);

CREATE TYPE TELEPHONE_TYPE AS ENUM ('fixe','portable','pro'); /*ENUM type du telephone*/

CREATE TABLE Candidats(
      id_candidat INTEGER REFERENCES Individus(id_individu),
      identifiant VARCHAR(50) UNIQUE NOT NULL,  /*clé candidate*/
      mot_de_passe VARCHAR(50) NOT NULL,
      telephone VARCHAR(20) NOT NULL,
      telephone_type TELEPHONE_TYPE NOT NULL,
      URL_web VARCHAR(255),
      type_web VARCHAR(5),
      CHECK (type_web IN ('perso','pro')),
      PRIMARY KEY (id_candidat)
);

/*
CREATE VIEW Referents_et_candidats  AS 
SELECT id_referents FROM Referents 
INTERSECT 
SELECT id_candidat FROM Candidats;
*/
CREATE TABLE Referents(
      id_referent INTEGER REFERENCES Individus(id_individu),
      situation_pro VARCHAR(50),
      employeur VARCHAR(50),
      telephone VARCHAR(20),
      telephone_type TELEPHONE_TYPE,
      PRIMARY KEY (id_referent)

);
/*CETTE CONTRAINTE NE MARCHE PAS
      CHECK( (SELECT id_referents FROM Referents INTERSECT SELECT 	id_candidat FROM Candidats) IS NULL)
*/

/* !!! CONTRAINTES (héritage référence)
Proj(Individu, id_individu) IN Proj(Candidats, id_candidat) UNION Proj(Referents, id_referent)
 */

CREATE TABLE CV(
	id_CV SERIAL PRIMARY KEY,
      candidat INTEGER REFERENCES Candidats(id_candidat),
      statut VARCHAR(12),
      date_creation DATE NOT NULL,
      date_maj DATE NOT NULL,
      CHECK (statut IN ('desactive','active','confidentiel'))
);
/*modification de la table car une clé étrangère ne peut pas être clé primaire à elle seule*/

CREATE TABLE CV_Traduit (
      id_CV INTEGER REFERENCES CV(id_CV),
      langue LANGUE NOT NULL,
      titre VARCHAR(60) NOT NULL,
      infos_complementaires TEXT,
      PRIMARY KEY (id_CV,langue)
);

/* Relations entre les classes */

CREATE TABLE  Posseder_Competence(
   id_candidat INTEGER REFERENCES Candidats(id_candidat),
   nom VARCHAR(50),
   langue LANGUE,
   PRIMARY KEY (id_candidat, nom ,langue),
   FOREIGN KEY (nom, langue) REFERENCES Competences( nom,langue )
);

CREATE TABLE Suivre_Formation(
   id_candidat INTEGER REFERENCES Candidats(id_candidat),
   id_formation INTEGER REFERENCES Formations(id_formation),
   PRIMARY KEY (id_candidat, id_formation)
);

CREATE TABLE Avoir_Experience(
   id_candidat INTEGER REFERENCES Candidats(id_candidat),
   id_exp_pro INTEGER REFERENCES Experiences_Pro(id_exp_pro),
   PRIMARY KEY(id_candidat, id_exp_pro)
);

CREATE TABLE Participer_Association(
   id_candidat INTEGER REFERENCES Candidats(id_candidat),
   id_asso INTEGER REFERENCES Postes_Associations(id_asso),
   PRIMARY KEY(id_candidat,id_asso)
);


CREATE TABLE Ecrire_Publication(
	id_candidat INTEGER REFERENCES Candidats(id_candidat),
	id_publication INTEGER REFERENCES Publications(id_pub),
	PRIMARY KEY (id_candidat, id_publication)
);

CREATE TABLE Parler_Langue(
	id_candidat INTEGER REFERENCES Candidats(id_candidat),
	id_langue INTEGER,
	niveau_langue CHAR(2),
	CHECK (niveau_langue IN ('A0','A1','A2','B1','B2','C1','C2')),
	FOREIGN KEY (id_langue) REFERENCES Langues(id),
	PRIMARY KEY( id_candidat,id_langue)
);

CREATE TABLE Posseder_Referent(
    id_candidat INTEGER REFERENCES Candidats(id_candidat),
    id_referent INTEGER REFERENCES Referents(id_referent),
    PRIMARY KEY(id_candidat, id_referent)
    
);
/* MARCHE PAS: erreur : ne peut pasn utiliser une sous-requête dans la contrainte de vérification
CHECK( (SELECT id_candidat FROM Candidats) IN (SELECT id_candidat FROM Posseder_Referent) )
*/
COMMIT;
