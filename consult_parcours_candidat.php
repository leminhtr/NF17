<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consulter le parcours d'un candidat</title>
</head>
<body>

<div id="contenu">
    <div id="Menu">
    </div>
    <div id="Bienvenue">
    </div>
</div>

<nav>
    <ul>
        <li><a href="page1_projet.php">Accueil</a></li>
        </br>
        <p>Espace Candidats</p>
        </br>
        <li><a href="insert.php">Ajouter votre CV</a></li>
        <li><a href="check.php">Modifier votre CV</a></li>
        </br>
        <p>Espace Référents</p>
        </br>
        <li><a href="select.html">Consulter les CV</a></li>
    </ul>
</nav>

<style>
    nav{
        float:left;
        width:25%;
        height:100%;
        border-right:1px dashed #CCC;
        /*padding:20px;
        margin-top:40px;*/
    }
</style>

<h1>Consulter le parcours d'un candidat</h1>

<br>
<br>

<?php

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];

if(!empty($nom) and !empty($prenom))
{
    $nom= ucfirst(strtolower($nom));  //aBcD -> Abcd
    $prenom=ucfirst(strtolower($prenom));

    /*Connexion à la BDD*/
    include "connect_projet.php";
    $vConn = fConnect();

    $query_sql_individu="SELECT ic.nom, ic.prenom, ic.mail, ic.telephone, ic.telephone_type, ic.url_web, ic.type_web, statut_cv.statut, statut_cv.candidat /*toutes les infos d'un individu et son statut*/
    FROM individus_candidats ic,
    (SELECT CV.candidat, CV.statut                    /*sous table : Que les CV qui existent, sans le statut desactive*/
     FROM CV
     JOIN candidats c ON cv.candidat = c.id_candidat  /*jointure : tous les CV appartenant aux candidats*/
     WHERE CV.statut<>'desactive')                                 /*ce CV n'étant pas desactive*/
     AS statut_cv                                     /*nom sous table*/
WHERE ic.id_individu=statut_cv.candidat               /*que les individus qui n'ont pas un cv à statut desactive*/
    AND lower(ic.nom)=lower('$nom')
    AND lower(ic.prenom)=lower('$prenom');";

    $query_individu=pg_query($vConn,$query_sql_individu);

    $nb_candidat_found=pg_num_rows($query_individu);    //nombre de résultat query

    echo"Nous avons trouvé $nb_candidat_found candidat(s) s'appelant <i>$nom $prenom</i>.<br><br>";

    if($nb_candidat_found>0)
    {
        $array_id_candidat=array();
        while($row_individu=pg_fetch_array($query_individu))    //stockage id_candidat correspondant à nom/prénom
        {
            $array_id_candidat[]=$row_individu['candidat'];
        }

        $row_individu=pg_result_seek($query_individu, 0);   //reset fetch query
        $i=0;
        $j=0;

        for($i=0 ;$i<$nb_candidat_found ;$i++)  //affichage CV pour chaque candidat
        {
            echo"<center><h2>$nom $prenom </h2></center>";

            echo"<h3>Profil personnel</h3>";    //coordonnée si activé

            while($row_individu=pg_fetch_array($query_individu))
            {

                if($row_individu[7]=='active')  //statut activé => coordonnée disponible
                    {
                        echo"<table>";

                        echo"<tr>";
                        echo"<th>Mail</th>";
                        echo"<th>Téléphone</th>";
                        echo"<th>Site web et type de site</th>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td><center><b>$row_individu[2]</b></center</td>";  //Mail
                        echo"<td><center>Téléphone $row_individu[4] : <b>$row_individu[3]</b></center</td>";  //Téléphone
                        echo"<br>";
                        if(empty($row_individu[5]))
                            echo"<td><center><i>Non renseigné</i></center></td>";          //Site web est vide
                        elseif (empty($row_individu[6]))                            //Site web non vide et type vide
                        {
                            echo"<td><center><a href='$row_individu[5]' target='_blank'>$row_individu[5]</a> <i>(Non renseigné)</i></center></td>";          //Site web est vide
                        }
                        else
                            echo"<td><center>Site $row_individu[6] : <a href='$row_individu[5]' target='_blank'>$row_individu[5]</a></center></td>"; //Site web et type non vide
                        echo"</tr>";
                        echo"</table>";
                    }
            }
            echo"<br>";

            echo"<h3>Expérience professionnelle</h3>";

            $query_sql_experience="SELECT cep.fonction, cep.date_debut, cep.date_fin, cep.nom_entreprise, es.sa_fr, es.sa_en, cep.langue
            FROM candidats_experiences_pro cep
            JOIN entreprises_secteurs es ON cep.nom_entreprise=es.nom_entreprise
            WHERE cep.id_candidat='$array_id_candidat[$i]'
            ORDER BY (cep.date_debut);";

            $query_experience=pg_query($vConn,$query_sql_experience);

            $nb_experience_found=pg_num_rows($query_experience);    //nb. d'expérience du candidat
            echo"$nom $prenom a effectué $nb_experience_found expérience(s) professionnelle(s).<br><br>";

            if($nb_experience_found>0)
            {
                echo "<table>";
                echo "<tr>";
                echo "<th>Fonction</th>";
                echo "<th>Employeur</th>";
                echo "</tr>";

                while ($row_experience = pg_fetch_array($query_experience)) {
                    echo "<tr>";
                    echo "<td>$row_experience[0] de $row_experience[1] à $row_experience[2]</td>"; //Fonction de date_debut à date_fin

                    echo "<td>$row_experience[3] <i>($row_experience[4] | $row_experience[5])</i><td>"; //Entreprise (secteur_fr | secteur_en)
                    echo "</tr>";
                }

                echo "</table>";
            }

            echo"<h3>Formations</h3>";

            $query_sql_formation="SELECT DISTINCT cf.titre, cf.type, cf.langue, cf.date_debut, cf.date_fin, cf.etablissement, cf.ville, cf.pays, cd.de_fr, cd.de_en
                                  FROM candidats_formations cf
                                  JOIN candidats_domaines cd ON cd.domaine_etude=cf.domaine_etude
                                  WHERE cf.id_candidat='$array_id_candidat[$i]';";
            $query_formation=pg_query($vConn,$query_sql_formation);

            $nb_formation_found=pg_num_rows($query_formation);  //nb. formation suivie par candidat

            echo"$nom $prenom a suivi $nb_formation_found formation(s).<br><br>";

            if($nb_formation_found>0)
            {
                echo "<table>";

                echo "<tr>";
                echo "<th>Diplôme</th>";
                echo "<th>Etablissement</th>";
                echo "<th>Domaine d'étude</th>";
                echo "</tr>";

                while ($row_formation = pg_fetch_array($query_formation)) {
                    echo "<tr>";
                    echo "<td>$row_formation[0] <i>($row_formation[1])</i> suivie de $row_formation[3] à $row_formation[4]</td>";
                    echo "<td>$row_formation[5] - $row_formation[6] ($row_formation[7])</td>";
                    echo "<td>$row_formation[8] | $row_formation[9]";
                    echo "</tr>";

                }

                echo "</table>";
            }

            echo"<h3>Langues</h3>";

            $query_sql_langue="SELECT cl.nom_fr, cl.nom_en, cl.niveau_langue
                               FROM candidats_langues cl
                               WHERE cl.id_candidat='$array_id_candidat[$i]';";
            $query_langue=pg_query($vConn,$query_sql_langue);

            $nb_langue_found=pg_num_rows($query_langue);

            echo"$nom $prenom parle $nb_langue_found langue(s).<br><br>";

            if($nb_langue_found>0)
            {
                echo"<table>";
                echo"<tr>";
                echo"<th> Langue</th>";
                echo"<th>Niveau</th>";
                echo"</tr>";

                while ($row_langue=pg_fetch_array($query_langue))
                {
                    echo "<tr>";
                    echo"<td>$row_langue[0] | $row_langue[1]</td>";
                    echo"<td>$row_langue[2]</td>";
                    echo"</tr>";
                }

            }












        }
    }







}

else
{
    echo"Erreur : La saisie est incomplète. <br><br>";
    echo"<a href=\"consult_parcours_candidat.html\">Retour à la saisie pour la consultation d'un candidat.</a>";
}

?>