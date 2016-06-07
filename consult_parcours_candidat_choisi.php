<!DOCTYPE html>
<html>
<?php
include 'mise_en_page.html';
?>

<h1>Consulter le parcours d'un candidat</h1>

<br>


<?php

//Récupération des variables
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$langue=$_POST['langue'];
$id_candidat=$_POST['id_candidat'];

if(empty($nom) or empty($prenom) or empty($langue) or empty($id_candidat))
{
echo"<br><br>Erreur de saisie.";
echo"<br><br><a href='consult_parcours_candidat.html'>Chercher un candidat par son nom.</a>";
echo"<br><br><a href='consult_candidat_critere.php'>Chercher un candidat selon plusieurs critères.</a>";
}
else
{
    $nom = ucfirst(strtolower($nom));  //aBcD -> Abcd
    $prenom = ucfirst(strtolower($prenom));

    /*Connexion à la BDD*/
    include "connect_projet.php";
    $vConn = fConnect();


    echo "Vous avez choisi de consulter le candidat $nom $prenom ID n°$id_candidat.<br>";

//RECHERCHE EXISTENCE ET PROFIL CANDIDAT.
    $query_sql_individu = "SELECT ic.nom, ic.prenom, ic.mail, ic.telephone, ic.telephone_type, ic.url_web, ic.type_web, statut_cv.statut, statut_cv.candidat /*toutes les infos d'un individu et son statut*/
    FROM individus_candidats ic,
    (SELECT CV.candidat, CV.statut                    /*sous table : Que les CV qui existent, sans le statut desactive ou confidentiel*/
     FROM CV
     JOIN candidats c ON cv.candidat = c.id_candidat  /*jointure : tous les CV appartenant aux candidats*/
     WHERE CV.statut<>'desactive'
           OR CV.statut<>'confidentiel')              /*ce CV n'étant pas desactive ou confidentiel*/
     AS statut_cv                                     /*nom sous table*/
WHERE ic.id_individu=statut_cv.candidat               /*que les individus qui n'ont pas un cv à statut desactive ou confidentiel*/
    AND ic.id_individu='$id_candidat';";

    $query_individu = pg_query($vConn, $query_sql_individu);

    echo "<center><h2>$nom $prenom </h2></center>";

    $query_sql_cv = "SELECT cvt.langue, cvt.titre, cvt.infos_complementaires
                       FROM cv_traduit cvt
                       JOIN CV ON cvt.id_cv = cv.id_cv
                       WHERE cv.candidat='$id_candidat'
                       AND cvt.langue='$langue';";

    $query_cv = pg_query($vConn, $query_sql_cv);

    $nb_cv_found = pg_num_rows($query_cv);    //nombre d'individu trouvé

    while ($row_cv = pg_fetch_array($query_cv)) {
        echo "<h2>$row_cv[1] ($row_cv[0])</h2>";
    }
    $row_cv = pg_result_seek($query_cv, 0);


    echo "<h3>Profil personnel</h3>";    //coordonnée si activé

    while ($row_individu = pg_fetch_array($query_individu)) {
        echo "<table>";

        echo "<tr>";
        echo "<th>Mail</th>";
        echo "<th>Téléphone</th>";
        echo "<th>Site web et type de site</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<td><center>$row_individu[2]</center</td>";  //Mail
        echo "<td><center>Téléphone $row_individu[4] : <b>$row_individu[3]</b></center</td>";  //Téléphone
        echo "<br>";
        if (empty($row_individu[5]))
            echo "<td><center><i>Non renseigné</i></center></td>";          //Site web est vide
        elseif (empty($row_individu[6]))                            //Site web non vide et type vide
        {
            echo "<td><center><a href='$row_individu[5]' target='_blank'>$row_individu[5]</a> <i>(Non renseigné)</i></center></td>";          //Site web est vide
        } else
            echo "<td><center>Site $row_individu[6] : <a href='$row_individu[5]' target='_blank'>$row_individu[5]</a></center></td>"; //Site web et type non vide
        echo "</tr>";
        echo "</table>";
    }
    echo "<br>";

    echo "<h3>Expérience professionnelle</h3>";

    if ($langue == 'FR') {
        $query_sql_experience = "SELECT cep.fonction, cep.date_debut, cep.date_fin, cep.nom_entreprise, es.sa_fr
            FROM candidats_experiences_pro cep
            JOIN entreprises_secteurs es ON cep.nom_entreprise=es.nom_entreprise
            WHERE cep.id_candidat='$id_candidat'
                AND cep.langue='$langue'
            ORDER BY (cep.date_debut);";

        $query_experience = pg_query($vConn, $query_sql_experience);

        $nb_experience_found = pg_num_rows($query_experience);    //nb. d'expérience du candidat
        echo "$nom $prenom a effectué $nb_experience_found expérience(s) professionnelle(s).<br><br>";

        if ($nb_experience_found > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Fonction</th>";
            echo "<th>Employeur</th>";
            echo "</tr>";

            while ($row_experience = pg_fetch_array($query_experience)) {
                echo "<tr>";
                echo "<td>$row_experience[0] de $row_experience[1] à $row_experience[2]</td>"; //Fonction de date_debut à date_fin

                echo "<td><center>$row_experience[3] <i>($row_experience[4])</i></center><td>"; //Entreprise (secteur_fr)
                echo "</tr>";
            }

            echo "</table>";
        }

        echo "<h3>Formations</h3>";

        $query_sql_formation = "SELECT DISTINCT cf.titre, cf.type, cf.date_debut, cf.date_fin, cf.etablissement, cf.ville, cf.pays, cd.de_fr
                                  FROM candidats_formations cf
                                  JOIN candidats_domaines cd ON cd.domaine_etude=cf.domaine_etude
                                  WHERE cf.langue='$langue'
                                      AND cf.id_candidat='$id_candidat';";
        $query_formation = pg_query($vConn, $query_sql_formation);

        $nb_formation_found = pg_num_rows($query_formation);  //nb. formation suivie par candidat

        echo "$nom $prenom a suivi $nb_formation_found formation(s).<br><br>";

        if ($nb_formation_found > 0) {
            echo "<table>";

            echo "<tr>";
            echo "<th>Diplôme</th>";
            echo "<th>Etablissement</th>";
            echo "<th>Domaine d'étude</th>";
            echo "</tr>";

            while ($row_formation = pg_fetch_array($query_formation)) {
                echo "<tr>";
                echo "<td>$row_formation[0] <i>($row_formation[1])</i> suivi de $row_formation[2] à $row_formation[3]</td>";    //Diplôme (type diplôme) suivi de date_debut à date_fin
                echo "<td><center>$row_formation[4] - $row_formation[5] ($row_formation[6])</center></td>"; //Etablissement - Ville(Pays)
                echo "<td><center>$row_formation[7]</center></td>";   //Domaine étude_FR
                echo "</tr>";

            }

            echo "</table>";
        }

        echo "<h3>Langues</h3>";

        $query_sql_langue = "SELECT cl.nom_fr, cl.niveau_langue
                               FROM candidats_langues cl
                               WHERE cl.id_candidat='$id_candidat';";
        $query_langue = pg_query($vConn, $query_sql_langue);

        $nb_langue_found = pg_num_rows($query_langue);

        echo "$nom $prenom parle $nb_langue_found langue(s).<br><br>";

        if ($nb_langue_found > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th><center>Langue</center></th>";
            echo "<th><center>Niveau</center></th>";
            echo "</tr>";

            while ($row_langue = pg_fetch_array($query_langue)) {
                echo "<tr>";
                echo "<td>$row_langue[0]</td>";  //Langue_fr
                echo "<td><center>$row_langue[1]</center></td>";  //Niveau
                echo "</tr>";
            }

        }
    } else    //Langue_EN
    {
        $query_sql_experience = "SELECT cep.fonction, cep.date_debut, cep.date_fin, cep.nom_entreprise, es.sa_en
                FROM candidats_experiences_pro cep
                JOIN entreprises_secteurs es ON cep.nom_entreprise=es.nom_entreprise
                WHERE cep.id_candidat='$id_candidat'
                    AND cep.langue='$langue'
                ORDER BY (cep.date_debut);";

        $query_experience = pg_query($vConn, $query_sql_experience);

        $nb_experience_found = pg_num_rows($query_experience);    //nb. d'expérience du candidat
        echo "$nom $prenom a effectué $nb_experience_found expérience(s) professionnelle(s).<br><br>";

        if ($nb_experience_found > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Fonction</th>";
            echo "<th>Employeur</th>";
            echo "</tr>";

            while ($row_experience = pg_fetch_array($query_experience)) {
                echo "<tr>";
                echo "<td>$row_experience[0] de $row_experience[1] à $row_experience[2]</td>"; //Fonction de date_debut à date_fin

                echo "<td><center>$row_experience[3] <i>($row_experience[4])</i></center><td>"; //Entreprise (secteur_fr)
                echo "</tr>";
            }

            echo "</table>";
        }

        echo "<h3>Formations</h3>";

        $query_sql_formation = "SELECT DISTINCT cf.titre, cf.type, cf.date_debut, cf.date_fin, cf.etablissement, cf.ville, cf.pays, cd.de_en
                                  FROM candidats_formations cf
                                  JOIN candidats_domaines cd ON cd.domaine_etude=cf.domaine_etude
                                  WHERE cf.langue='$langue'
                                      AND cf.id_candidat='$id_candidat';";
        $query_formation = pg_query($vConn, $query_sql_formation);

        $nb_formation_found = pg_num_rows($query_formation);  //nb. formation suivie par candidat

        echo "$nom $prenom a suivi $nb_formation_found formation(s).<br><br>";

        if ($nb_formation_found > 0) {
            echo "<table>";

            echo "<tr>";
            echo "<th>Diplôme</th>";
            echo "<th>Etablissement</th>";
            echo "<th>Domaine d'étude</th>";
            echo "</tr>";

            while ($row_formation = pg_fetch_array($query_formation)) {
                echo "<tr>";
                echo "<td>$row_formation[0] <i>($row_formation[1])</i> suivi de $row_formation[2] à $row_formation[3]</td>";    //Diplôme (type diplôme) suivi de date_debut à date_fin
                echo "<td><center>$row_formation[4] - $row_formation[5] ($row_formation[6])</center></td>"; //Etablissement - Ville(Pays)
                echo "<td><center>$row_formation[7]</center></td>";   //Domaine étude_FR
                echo "</tr>";

            }

            echo "</table>";
        }

        echo "<h3>Langues</h3>";

        $query_sql_langue = "SELECT cl.nom_en, cl.niveau_langue
                               FROM candidats_langues cl
                               WHERE cl.id_candidat='$id_candidat';";
        $query_langue = pg_query($vConn, $query_sql_langue);

        $nb_langue_found = pg_num_rows($query_langue);

        echo "$nom $prenom parle $nb_langue_found langue(s).<br><br>";

        if ($nb_langue_found > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th><center>Langue</center></th>";
            echo "<th><center>Niveau</center></th>";
            echo "</tr>";

            while ($row_langue = pg_fetch_array($query_langue)) {
                echo "<tr>";
                echo "<td>$row_langue[0]</td>";  //Langue_en
                echo "<td><center>$row_langue[1]</center></td>";  //Niveau
                echo "</tr>";
            }
        }

        if ($nb_cv_found != 0) {
            echo "<h3>Informations complémentaires</h3><br>";

            while ($row_cv = pg_fetch_array($query_cv)) {
                echo "$row_cv[3]"; //infos complémentaires
            }
        }
    }
}


?>