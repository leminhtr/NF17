CREATE VIEW candidats_domaines AS
  SELECT c.identifiant, de.de_fr, de.de_en
  FROM domaines_etudes de
  JOIN formations f ON de.id_de = f.domaine_etude
  JOIN suivre_formation sf ON f.id_formation = sf.id_formation
  JOIN candidats c ON sf.id_candidat = c.id_candidat
;

CREATE OR REPLACE VIEW individus_candidats AS
  SELECT i.id_individu, i.nom, i.prenom, i.mail, c.telephone, c.telephone_type, c.url_web, c.type_web
  FROM individus i
  JOIN candidats c ON i.id_individu = c.id_candidat
  ORDER BY (i.nom)
;

