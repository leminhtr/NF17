CREATE OR REPLACE FUNCTION duree_exp_pro_tot (candidat INTEGER) /*durée total de travail d'un candidat en jours*/
  RETURNS DOUBLE PRECISION AS $total$
declare
  total DOUBLE PRECISION;
BEGIN
     SELECT SUM(ep.date_fin-ep.date_debut) into total
     FROM experiences_pro ep
     JOIN avoir_experience ae ON ep.id_exp_pro = ae.id_exp_pro
     WHERE ae.id_candidat=candidat;
   RETURN total;
END;
$total$ LANGUAGE plpgsql;