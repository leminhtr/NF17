<!DOCTYPE html>
<html>
<?php
include 'mise_en_page.html';
?>

<h1>Rechercher les candidats qui correspondent à vos critères</h1>

<br>
<br>
<br>

<?php

$domaine_array=$_POST['domaine'];
$nb_exp=$_POST['nb_exp'];
$duree=$_POST['duree_exp'];
$langue_array=$_POST['langue'];


if((empty($domaine_array)) && (empty($nb_exp)) && (empty($duree)) && (empty($langue_array)))
{
    echo"Erreur de saisie.<br><br>";
    echo"<a href='consult_candidat_critere.php'>Retour à la recherche</a>";
}

else
{

    /*Connexion à la BDD*/
    include "connect_projet.php";
    $vConn = fConnect();

    //Condition SQL IN ('condition1', 'condition2',...) pour select multiple formulaire
    if(count($domaine_array)>0)
    {
        $domaine_array_implode = implode("','", $domaine_array);
        $domaine_array_implode = "'".$domaine_array_implode."'";    //('Info', 'Bio')

        $condition_domaine="AND cd.de_fr IN ($domaine_array_implode)";
    }
    else
    {
        $condition_domaine='';
    }

    if(count($langue_array)>0)
    {
        $langue_array_implode = implode("','", $langue_array);
        $langue_array_implode = "'".$langue_array_implode."'";  //('Français', 'Anglais',...)

        $condition_langue="AND cl.nom_fr IN ($langue_array_implode)";
        echo "$condition_langue";
    }
    else
    {
        $condition_langue='';
    }

    if(!(empty($duree)))
    {
        switch ($duree)     //définition des bornes min du temps d'expérience [duree_min;duree] (en jours)
        {
            case 365 :  //<1 an
                $duree_min=0;

                break;
            case 1095 : //[1;3] ans
                $duree_min=366;
                break;
            case 1825 : //[3;5] ans
                $duree_min=1096;
                break;
            //pas de borne min pour > 5 ans(>1826)
            }
        if($duree==1826)
        {
            $condition_duree_exp="AND duree_exp_pro_tot((ic.id_individu))>$duree";
        }
        else
        {
            $condition_duree_exp="AND duree_exp_pro_tot((ic.id_individu)) BETWEEN $duree_min AND $duree";
        }

    }

    if(!(empty($nb_exp)))
    {
        $condition_nb_exp="HAVING COUNT (DISTINCT cep.date_debut)>$nb_exp";
    }
    else
    {
        $condition_nb_exp='';
    }

    $query_sql_recherche_basique="SELECT ic.id_individu, ic.nom, ic.prenom, cf.titre, extract(YEAR from max(cf.date_fin)), duree_exp_pro_tot(ic.id_individu), COUNT(DISTINCT cep.date_debut)
                                FROM individus_candidats ic
                                JOIN candidats_domaines cd ON ic.id_individu=cd.id_candidat
                                JOIN candidats_experiences_pro cep ON cep.id_candidat=cd.id_candidat
                                JOIN candidats_langues cl ON cl.id_candidat=cep.id_candidat
                                JOIN candidats_formations cf ON cf.id_candidat=cl.id_candidat
                                WHERE cep.langue='FR'
                                      AND cf.langue='FR'
                                      AND cf.date_fin= (select max(cf2.date_fin)  /*Dernière formations*/
                                                        from candidats_formations cf2
                                                        WHERE cf2.id_candidat=cf.id_candidat)";

    $GROUP_BY="GROUP BY ic.id_individu, ic.nom, ic.prenom,  duree_exp_pro_tot(ic.id_individu), extract(YEAR FROM cf.date_fin), cf.titre";
    //$query_sql_recherche_candidat=$query_sql_recherche_candidat.$condition_finale.$GROUP_BY.$HAVING;

$condition_finale=$condition_domaine.' '.$condition_langue.' '.$condition_duree_exp.' '.$GROUP_BY.' '.$condition_nb_exp;
        echo"<br>$condition_finale<br>";

    $query_sql_recherche_candidat=$query_sql_recherche_basique.$condition_finale.';';
    echo"<br><br>$query_sql_recherche_candidat<br>";

   /* $query_sql_recherche_candidat="SELECT ic.id_individu, ic.nom, ic.prenom, cf.titre, extract(YEAR from max(cf.date_fin)), duree_exp_pro_tot(ic.id_individu), COUNT(DISTINCT cep.date_debut)
                                FROM individus_candidats ic
                                JOIN candidats_domaines cd ON ic.id_individu=cd.id_candidat
                                JOIN candidats_experiences_pro cep ON cep.id_candidat=cd.id_candidat
                                JOIN candidats_langues cl ON cl.id_candidat=cep.id_candidat
                                JOIN candidats_formations cf ON cf.id_candidat=cl.id_candidat
                                WHERE cep.langue='FR'
                                      AND cf.langue='FR'
                                      AND cf.date_fin= (select max(cf2.date_fin)  /*Dernière formations
                                                        from candidats_formations cf2
                                                        WHERE cf2.id_candidat=cf.id_candidat)
                                      AND cl.nom_fr IN ($condition_langue)
                                      AND cd.de_fr IN ($condition_domaine)
                                      AND duree_exp_pro_tot((ic.id_individu))>$duree
                                GROUP BY ic.id_individu, ic.nom, ic.prenom,  duree_exp_pro_tot(ic.id_individu), extract(YEAR FROM cf.date_fin), cf.titre
                                HAVING COUNT (DISTINCT cep.date_debut)>$nb_exp";
*/
        $query_recherche_candidat=pg_query($vConn,$query_sql_recherche_candidat);
        $nb_candidat_found=pg_num_rows($query_recherche_candidat);
        echo"Nous avons trouvé $nb_candidat_found candidat(s) correspondant(s) à vos critères.<br><br>";

    if($nb_candidat_found==0)
    {
        echo"<a href='consult_candidat_critere.php'>Refaire une recherche</a>";
    }

    else
    {
        //Stockage ID candidats trouvés
        $array_id_candidat=array();
        while ($row_recherche_candidat=pg_fetch_array($query_recherche_candidat))
        {
            $array_id_candidat[]=$row_recherche_candidat['id_individu'];
        }

        $row_recherche_candidat=pg_result_seek($query_recherche_candidat,0);    //reset fetch query

        //Table affichage récapitulatif résultat
        /*|Infos perso  |                    Formations                    |          Expériences
         *|ID|Nom|Prenom|Dernier diplôme + date|domaines d'études|langues  |durée_exp_total|Nombre d'expérience pro
         *|0 | 1 |2     |       3        +  4  |      subquery1  |subquery2|  5            |      6
         */

        echo"<table>";
        echo"<tr>";
        echo"<th colspan='3' align='left'>Informations personnelles</th>";
        echo"<th colspan='3' align='left'>Formations</th>";
        echo"<th colspan='2' align='left'>Expériences</th>";
        echo "</tr>";

        echo"<tr>";
        echo"<td>ID</td>";
        echo"<td>Nom</td>";
        echo"<td>Prénom</td>";
        echo"<td>Dernier diplôme et date</td>";
        echo"<td>Domaines d'études</td>";
        echo"<td>Langues</td>";
        echo"<td>Durée d'expérience totale</td>";
        echo"<td>Nombre d'expériences professionelles</td>";
        echo"</tr>";

        echo"<form method='post' action='consult_parcours_candidat_choisi.php'> ";
        while ($row_recherche_candidat=pg_fetch_array($query_recherche_candidat))
        {
            $id_candidat=$row_recherche_candidat[0];
            echo"<tr>";
            echo"<td><input type='radio'value='$row_recherche_candidat[0]' name='id_candidat'>$row_recherche_candidat[0]</td> <td>$row_recherche_candidat[1]</td><td>$row_recherche_candidat[2]</td>";    //ID Nom Prénom
            echo"<td>$row_recherche_candidat[3]<br>diplômé(e) en $row_recherche_candidat[4]</td>";    //titre diplôme en année

                if(count($domaine_array)>0) //listes tous les domaines maîtrisés
                {
                    $query_sql_recherche_candidat_domaine="SELECT cd.de_fr,cd.de_en
                                           FROM candidats_domaines cd
                                           WHERE cd.id_candidat='$id_candidat';";
                    $query_recherche_candidat_domaine=pg_query($vConn,$query_sql_recherche_candidat_domaine);

                    echo"<td>";   //domaine étude
                    while ($row_recherche_candidat_domaine=pg_fetch_array($query_recherche_candidat_domaine))
                    {
                        echo"$row_recherche_candidat_domaine[0] | $row_recherche_candidat_domaine[1]<br>";
                    }
                    echo"</td>";
                }

                if(count($langue_array)>0)  //print liste toutes les langues parlées
                {
                    $query_sql_recherche_candidat_langue="SELECT cl.nom_fr, cl.nom_en
                                               FROM candidats_langues cl
                                               WHERE cl.id_candidat='$id_candidat';";
                    $query_recherche_candidat_langue=pg_query($vConn,$query_sql_recherche_candidat_langue);

                    echo"<td>";   //domaine étude
                    while ($row_recherche_candidat_domaine=pg_fetch_array($query_recherche_candidat_domaine))
                    {
                        echo"$row_recherche_candidat_domaine[0] | $row_recherche_candidat_domaine[1]<br>";
                    }
                    echo"</td>";
                }
                $duree_tot=$row_recherche_candidat[5];
                if($duree_tot>0 and $duree_tot<30)
                    echo"<td>$duree_tot jours</td>";   //duree_exp_total
                if($duree_tot>=30 && $duree_tot<=365)
                {
                    $month = ($duree_tot % 365) / 30.5; // 30+31/2
                    $month = floor($month);             // Arrondi
                    $days = ($duree_tot % 365) % 30.5;

                    echo"<td>$month mois et $days jour(s)";
                }
                if($duree_tot>365)
                {
                    $years = ($duree_tot / 365) ; // days / 365 days
                    $years = floor($years); // Arrondi

                    $month = ($duree_tot % 365) / 30.5; // 30+31/2
                    $month = floor($month); // Arrondi

                    echo"<td>$years an(s) et $month mois";
                }
            echo"<td>$row_recherche_candidat[6]</td>";   //nb_exp
            echo"</tr>";

            echo"<input type='hidden' value=$row_recherche_candidat[1] name='nom'>";
            echo"<input type='hidden' value=$row_recherche_candidat[2] name='prenom'>";
        }
        echo"<tr>";
        echo"<td></td>";
        echo"</tr>";
        echo"<tr>";
        echo"<td></td>";
        echo"</tr>";

        echo"<tr>";
        echo"<td rowspan='2'>Sélectionner une langue pour<br>consulter le CV du candidat choisi.";
        echo"<td>Français<input type='radio' value='FR' name='langue'></td>";
        echo"</tr>";
        echo"<tr>";
        echo"<td>Anglais<input type='radio' value='EN' name='langue'></td>";
        echo"</tr>";

        echo"<tr>";
        echo"<td></td>";
        echo"</tr>";
        echo"<tr>";
        echo"<td></td>";
        echo"</tr>";

        echo"<tr>";
        echo"<td><input type='submit' value='Consulter ce candidat'></td>";
        echo"</tr>";


    }

}































?>

