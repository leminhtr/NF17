CREATE OR REPLACE VIEW individus_candidats AS
  SELECT i.id_individu, i.nom, i.prenom, i.mail, c.telephone, c.telephone_type, c.url_web, c.type_web
  FROM individus i
  JOIN candidats c ON i.id_individu = c.id_candidat
  ORDER BY (i.nom)
;

CREATE OR REPLACE VIEW candidats_domaines AS
  SELECT c.id_candidat, de.de_fr, de.de_en, f.domaine_etude
  FROM domaines_etudes de
  JOIN formations f ON de.id_de = f.domaine_etude
  JOIN suivre_formation sf ON f.id_formation = sf.id_formation
  JOIN candidats c ON sf.id_candidat = c.id_candidat
;

CREATE OR REPLACE VIEW candidats_formations AS
  SELECT c.id_candidat,ft.titre, ft.type, ft.langue, f.date_debut, f.date_fin, f.etablissement, f.ville, f.pays, f.domaine_etude
  FROM formations f
  JOIN suivre_formation sf ON f.id_formation = sf.id_formation
  JOIN candidats c ON sf.id_candidat = c.id_candidat
  JOIN formations_traduites ft ON f.id_formation = ft.id_formation
;

CREATE OR REPLACE VIEW candidats_langues AS
  SELECT c.id_candidat, l.nom_fr, l.nom_en, pl.niveau_langue
  FROM candidats c
  JOIN parler_langue pl ON c.id_candidat = pl.id_candidat
  JOIN langues l ON pl.id_langue = l.id
;

CREATE OR REPLACE VIEW entreprises_secteurs AS
  SELECT se.nom_entreprise, sa.sa_fr, sa.sa_en
  FROM secteurs_activites sa
  JOIN secteurentreprise se ON sa.id_sa = se.secteur_activite
  ORDER BY (se.nom_entreprise)
;


CREATE OR REPLACE VIEW candidats_experiences_pro AS
  SELECT c.id_candidat, ept.fonction, ep.date_debut, ep.date_fin, ep.nom_entreprise, ept.langue
  FROM candidats c
  JOIN avoir_experience ae ON c.id_candidat = ae.id_candidat
  JOIN experiences_pro ep ON ae.id_exp_pro = ep.id_exp_pro
  JOIN experiences_pro_traduites ept ON ep.id_exp_pro = ept.id_exp_pro
  ORDER BY (c.identifiant)
;

SELECT cep.fonction, cep.date_debut, cep.date_fin, cep.nom_entreprise, es.sa_fr, es.sa_en
FROM candidats_experiences_pro cep
JOIN entreprises_secteurs es ON cep.nom_entreprise=es.nom_entreprise
WHERE cep.id_candidat=''
;




