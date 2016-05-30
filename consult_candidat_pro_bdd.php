<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consulter les candidats ayant comme compétence "base de donnée" et plus de 5 ans d'expériences</title>
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

<h1>Consulter les candidats ayant comme compétence "base de donnée" et plus de 5 ans d'expériences</h1>


<br>
<br>
<br>

<table>
    <tr>
        <th><center>Nom</center></th>
        <th><center>Prénom</center></th>
        <th><center>Mail</center></th>
        <th><center>Téléphone (type de numéro)</center></th>
        <th><center>Site web (type de site)</center></th>
    </tr>

<?php
/*Connexion à la BDD*/
include "connect_projet.php";
$vConn = fConnect();

/*============Récupération de la requête===========*/
$sql_query="SELECT ic.nom, ic.prenom, ic.mail, ic.telephone, ic.telephone_type, ic.url_web, ic.type_web, statut_cv.statut /*toutes les infos d'un individu et son statut*/
FROM individus_candidats ic,
    (SELECT CV.candidat, CV.statut                    /*sous table : Que les CV qui existent, sans le statut desactive*/
     FROM CV
     JOIN candidats c ON cv.candidat = c.id_candidat  /*jointure : tous les CV appartenant aux candidats*/
     WHERE CV.statut<>'desactive')                                 /*ce CV n'étant pas desactive*/
     AS statut_cv                                     /*nom sous table*/
WHERE ic.id_individu=statut_cv.candidat               /*que les individus qui n'ont pas un cv à statut desactive*/
      AND ic.id_individu IN(                          /*sous table : Que les individu qui possèdent la compétence \"base de donnée\"*/
        SELECT pc.id_candidat
        FROM posseder_competence pc
        JOIN candidats c ON pc.id_candidat = c.id_candidat  /*jointure : tous les candidats qui ont une compétence*/
        WHERE pc.nom='base de donnée')                                 /*cette compétence étant \"base de donnée*/
        AND duree_exp_pro_tot(ic.id_individu)>=1825         /*Qui ont plus de 5 ans d'expérience*/
ORDER BY (ic.nom);";

$query=pg_query($vConn,$sql_query);

/*==================Affichage de la reqûete=================*/
                /*2 cas : CV active, desactive*/

    while ($result=pg_fetch_array($query))
    {
        if($result[7]=='active')
        {
            echo"<tr>";
            echo"<td><center>$result[0]</center</td>";  //Nom
            echo"<td><center>$result[1]</center</td>";  //Prénon
            echo"<td><center>$result[2]</center</td>";  //Mail
            echo"<td><center>$result[3]</center</td>";  //Téléphone
            if(!empty($result[5]))
                echo"<td><center>$result[5]</center</td>";  //Site web (URL) non vide
            else
                echo"<td><center><i>Non renseigné</i></center></td>";          //Site web est vide
            echo"</tr>";

            echo"<tr>";                 //saut ligne car on veut type numero/type site en dessous du numero/site
            echo"<td></td><td></td><td></td>";
            echo"<td><center>($result[4])</center</td>";  //Type de numéro
            if(!empty($result[6]))
                echo"<td><center>($result[6])</center</td>";  //Type de site
            else
                echo"<td><center><i>Non renseigné</i></center></td>";          //Site web est vide
            echo"</tr>";
        }
        else    //confidentiel
        {
            echo"<tr>";
            echo"<td><center>$result[0]</center</td>";  //Nom
            echo"<td><center>$result[1]</center</td>";  //Prénon
            echo"</tr>";
        }
    }
        ?>
</table>