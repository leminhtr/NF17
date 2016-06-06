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
        <p>Espace Entreprise</p>
        </br>
        <li><a href="select.html">Consulter les CV</a></li>
        <br>
        <p>Espace Référents</p>
        </br>
        <li><a href="consult_referent.html">Consulter vos candidats</a></li>
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
$langue=$_POST['langue'];

if(!empty($nom) and !empty($prenom))
{
    $nom= ucfirst(strtolower($nom));  //aBcD -> Abcd
    $prenom=ucfirst(strtolower($prenom));

    /*Connexion à la BDD*/
    include "connect_projet.php";
    $vConn = fConnect();

    //RECHERCHE EXISTENCE ET PROFIL CANDIDAT.
    $query_sql_individu="SELECT ic.nom, ic.prenom, ic.mail, ic.telephone, ic.telephone_type, ic.url_web, ic.type_web, statut_cv.statut, statut_cv.candidat /*toutes les infos d'un individu et son statut*/
    FROM individus_candidats ic,
    (SELECT CV.candidat, CV.statut                    /*sous table : Que les CV qui existent, sans le statut desactive ou confidentiel*/
     FROM CV
     JOIN candidats c ON cv.candidat = c.id_candidat  /*jointure : tous les CV appartenant aux candidats*/
     WHERE CV.statut<>'desactive'
           OR CV.statut<>'confidentiel')              /*ce CV n'étant pas desactive ou confidentiel*/
     AS statut_cv                                     /*nom sous table*/
WHERE ic.id_individu=statut_cv.candidat               /*que les individus qui n'ont pas un cv à statut desactive ou confidentiel*/
    AND lower(ic.nom)=lower('$nom')
    AND lower(ic.prenom)=lower('$prenom');";

    $query_individu=pg_query($vConn,$query_sql_individu);

    $nb_candidat_found=pg_num_rows($query_individu);    //nombre d'individu trouvé

    echo"Nous avons trouvé $nb_candidat_found candidat(s) s'appelant <i>$nom $prenom</i>.<br><br>";

    

    $array_id_candidat=array();
    while($row_individu=pg_fetch_array($query_individu))    //stockage de tous les id_candidat correspondant à nom/prénom
    {
        $array_id_candidat[]=$row_individu['candidat'];
    }

    $row_individu=pg_result_seek($query_individu, 0);   //reset fetch query

    /*=========3 cas : I) aucun trouvé, II) + de 1 trouvé, III) 1 exactement trouvé===========*/


    //I) Cas aucun trouvé : Retour à la recherche/accueil
    if($nb_candidat_found==0)
    {
        echo"<a href='consult_parcours_candidat.html'> Refaire une recherche</a><br><br>";
        echo"<a href='page1_projet.php'> Retour à l'acceuil</a>";
    }

    //II) Cas +d'1 trouvé : Proposition choix du candidat à afficher

    if($nb_candidat_found>1)
    {
        echo"Quel candidat souhaitez-vous consulter ?<br><br>";

        echo"<table>";

        echo"<tr>";
        echo"<th>ID";
        echo"</tr>";

        echo"<form method='post' action='consult_parcours_candidat_choisi.php'>";

        foreach ($array_id_candidat as $id_candidat)
        {
            echo"<tr>";
            echo"<td>$id_candidat</td>";
            echo"<td><input type='radio' value='".$id_candidat."' name='id_candidat'></td>";
            echo"</tr>";
        }

        echo"</table>";

        echo"<input type='hidden' value='".$nom."' name='nom'>";
        echo"<input type='hidden' value='".$prenom."' name='prenom'>";
        echo"<input type='hidden' value='".$langue."' name='langue'>";

        echo"<br>";
        echo"<input type='submit' value='Consulter ce candidat'>";
        echo"</form>";
    }


    //III)Cas 1 candidat exactement trouvé : affichage normal
    if($nb_candidat_found==1)
    {

            echo"<center><h2>$nom $prenom </h2></center>";


        $query_sql_cv="SELECT cvt.langue, cvt.titre, cvt.infos_complementaires
                       FROM cv_traduit cvt
                       JOIN CV ON cvt.id_cv = cv.id_cv
                       WHERE cv.candidat='$id_candidat'
                       AND cvt.langue='$langue';";

        $query_cv=pg_query($vConn,$query_sql_cv);

        $nb_cv_found=pg_num_rows($query_cv);    //nombre d'individu trouvé

        while ($row_cv=pg_fetch_array($query_cv))
        {
            echo"<h2>$row_cv[1] ($row_cv[0])</h2>";
        }
        $row_cv=pg_result_seek($query_cv,0);
        
        echo"<h3>Profil personnel</h3>";    //coordonnée si activé

        while($row_individu=pg_fetch_array($query_individu))
        {
                    echo"<table>";

                    echo"<tr>";
                    echo"<th>Mail</th>";
                    echo"<th>Téléphone</th>";
                    echo"<th>Site web et type de site</th>";
                    echo"</tr>";

                    echo"<tr>";
                    echo"<td><center>$row_individu[2]</center</td>";  //Mail
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
        echo"<br>";

        echo"<h3>Expérience professionnelle</h3>";

    if($langue=='FR')
    {
        $query_sql_experience="SELECT cep.fonction, cep.date_debut, cep.date_fin, cep.nom_entreprise, es.sa_fr
        FROM candidats_experiences_pro cep
        JOIN entreprises_secteurs es ON cep.nom_entreprise=es.nom_entreprise
        WHERE cep.id_candidat='$array_id_candidat[0]'
            AND cep.langue='$langue'
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

                echo "<td><center>$row_experience[3] <i>($row_experience[4])</i></center><td>"; //Entreprise (secteur_fr)
                echo "</tr>";
            }

            echo "</table>";
        }

        echo"<h3>Formations</h3>";

        $query_sql_formation="SELECT DISTINCT cf.titre, cf.type, cf.date_debut, cf.date_fin, cf.etablissement, cf.ville, cf.pays, cd.de_fr
                              FROM candidats_formations cf
                              JOIN candidats_domaines cd ON cd.domaine_etude=cf.domaine_etude
                              WHERE cf.langue='$langue'
                                  AND cf.id_candidat='$array_id_candidat[0]';";
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
                echo "<td>$row_formation[0] <i>($row_formation[1])</i> suivi de $row_formation[2] à $row_formation[3]</td>";    //Diplôme (type diplôme) suivi de date_debut à date_fin
                echo "<td><center>$row_formation[4] - $row_formation[5] ($row_formation[6])</center></td>"; //Etablissement - Ville(Pays)
                echo "<td><center>$row_formation[7]</center></td>";   //Domaine étude_FR
                echo "</tr>";

            }

            echo "</table>";
        }

        echo"<h3>Langues</h3>";

        $query_sql_langue="SELECT cl.nom_fr, cl.niveau_langue
                           FROM candidats_langues cl
                           WHERE cl.id_candidat='$array_id_candidat[0]';";
        $query_langue=pg_query($vConn,$query_sql_langue);

        $nb_langue_found=pg_num_rows($query_langue);

        echo"$nom $prenom parle $nb_langue_found langue(s).<br><br>";

        if($nb_langue_found>0)
        {
            echo"<table>";
            echo"<tr>";
            echo"<th><center>Langue</center></th>";
            echo"<th><center>Niveau</center></th>";
            echo"</tr>";

            while ($row_langue=pg_fetch_array($query_langue))
            {
                echo "<tr>";
                echo"<td>$row_langue[0]</td>";  //Langue_fr
                echo"<td><center>$row_langue[1]</center></td>";  //Niveau
                echo"</tr>";
            }

        }
    }

    else    //Langue_EN
        {
            $query_sql_experience="SELECT cep.fonction, cep.date_debut, cep.date_fin, cep.nom_entreprise, es.sa_en
            FROM candidats_experiences_pro cep
            JOIN entreprises_secteurs es ON cep.nom_entreprise=es.nom_entreprise
            WHERE cep.id_candidat='$array_id_candidat[0]'
                AND cep.langue='$langue'
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

                    echo "<td><center>$row_experience[3] <i>($row_experience[4])</i></center><td>"; //Entreprise (secteur_fr)
                    echo "</tr>";
                }

                echo "</table>";
            }

            echo"<h3>Formations</h3>";

            $query_sql_formation="SELECT DISTINCT cf.titre, cf.type, cf.date_debut, cf.date_fin, cf.etablissement, cf.ville, cf.pays, cd.de_en
                              FROM candidats_formations cf
                              JOIN candidats_domaines cd ON cd.domaine_etude=cf.domaine_etude
                              WHERE cf.langue='$langue'
                                  AND cf.id_candidat='$array_id_candidat[0]';";
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
                    echo "<td>$row_formation[0] <i>($row_formation[1])</i> suivi de $row_formation[2] à $row_formation[3]</td>";    //Diplôme (type diplôme) suivi de date_debut à date_fin
                    echo "<td><center>$row_formation[4] - $row_formation[5] ($row_formation[6])</center></td>"; //Etablissement - Ville(Pays)
                    echo "<td><center>$row_formation[7]</center></td>";   //Domaine étude_FR
                    echo "</tr>";

                }

                echo "</table>";
            }

            echo"<h3>Langues</h3>";

            $query_sql_langue="SELECT cl.nom_en, cl.niveau_langue
                           FROM candidats_langues cl
                           WHERE cl.id_candidat='$array_id_candidat[0]';";
            $query_langue=pg_query($vConn,$query_sql_langue);

            $nb_langue_found=pg_num_rows($query_langue);

            echo"$nom $prenom parle $nb_langue_found langue(s).<br><br>";

            if($nb_langue_found>0)
            {
                echo"<table>";
                echo"<tr>";
                echo"<th><center>Langue</center></th>";
                echo"<th><center>Niveau</center></th>";
                echo"</tr>";

                while ($row_langue=pg_fetch_array($query_langue))
                {
                    echo "<tr>";
                    echo"<td>$row_langue[0]</td>";  //Langue_en
                    echo"<td><center>$row_langue[1]</center></td>";  //Niveau
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