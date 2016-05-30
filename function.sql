CREATE OR REPLACE FUNCTION duree_exp_pro (candidat INTEGER, entreprise INTEGER) /*durée de travail d'un candidat dans une entreprise en jours*/
  RETURNS DOUBLE PRECISION AS $duree_jour$
declare
	duree_jour DOUBLE PRECISION;
BEGIN
   SELECT date_part('day', ep.date_fin::TIMESTAMP - ep.date_debut::TIMESTAMP) into duree_jour
   FROM experiences_pro ep
   JOIN avoir_experience ae ON ep.id_exp_pro = ae.id_exp_pro
   WHERE ae.id_candidat=candidat
        AND ae.id_exp_pro=entreprise;
   RETURN total;
END;
$duree_jour$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION duree_exp_pro_tot (candidat INTEGER) /*durée total de travail d'un candidat en jours*/
  RETURNS DOUBLE PRECISION AS $total$
declare
	total DOUBLE PRECISION;
  entreprise INTEGER;
  sum INTEGER DEFAULT 0;
BEGIN
   FOR entreprise IN SELECT ep.id_exp_pro FROM experiences_pro ep LOOP
     SELECT sum into total
     FROM experiences_pro ep
     JOIN avoir_experience ae ON ep.id_exp_pro = ae.id_exp_pro
     WHERE ae.id_candidat=candidat;
     sum:=sum+duree_exp_pro(candidat,entreprise);
   END LOOP;
  total:=sum;
   RETURN total;
END;
$total$ LANGUAGE plpgsql;

--==================Qui est l'employeur actuel dans l'UML ??????===========
/*
CREATE OR REPLACE FUNCTION employeur_actuelle (candidat INTEGER) /*durée total de travail d'un candidat en jours*/
  RETURNS VARCHAR(50) AS $employeur$
declare
	employeur DOUBLE PRECISION;
  entreprise INTEGER;
  sum INTEGER DEFAULT 0;
BEGIN
   FOR entreprise IN SELECT ep.id_exp_pro FROM experiences_pro ep LOOP
     SELECT sum into employeur
     FROM experiences_pro ep
     JOIN avoir_experience ae ON ep.id_exp_pro = ae.id_exp_pro
     WHERE ae.id_candidat=candidat;
     sum:=sum+duree_exp_pro(candidat,entreprise);
   END LOOP;
  employeur:=sum;
   RETURN employeur;
END;
$employeur$ LANGUAGE plpgsql;
*/