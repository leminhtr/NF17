<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rechercher les candidats qui correspondent à vos critères</title>
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

    switch ($duree){    //définition des bornes min du temps d'expérience [duree_min;duree] (en jours)
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


    //Condition SQL IN ($condition) pour select multiple formulaire
   // $condition_domaine = join("','",$domaine_array);
    //$condition_langue = join("','",$langue_array);

    if($duree==1826)
    {
        $query_sql_recherche=";";
    }

    else
    {
        $query_sql_recherche="SELECT * FROM individus_candidats;";
    }

    $query_recherche=pg_query($vConn,$query_sql_recherche);

    $nb_candidat_found=pg_num_rows($query_recherche);
    echo"Nous avons trouvé $nb_candidat_found candidats correspondants à vos critères.<br><br>";

    if($nb_candidat_found==0)
    {
        echo"<a href='consult_candidat_critere.php'>Refaire une recherche</a>";
    }

    else
    {
        //Stockage ID candidats trouvés
        $array_id_candidat=array();
        while ($row_recherche=pg_fetch_array($query_recherche))
        {
            $array_id_candidat[]=$row_recherche['id_individu'];
        }

        $row_recherche=pg_result_seek($query_recherche,0);    //reset fetch query

        //Table affichage récapitulatif résultat
        /*|Infos perso  |                    Formations                  |          Expériences
         *|ID|Nom|Prenom|Dernier diplôme + date|domaines d'études|langues|durée_exp_total|dernier poste
         *|0 | 1 |2     |       3        +  4  |        5        |  6    |      7        |      8
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
        echo"<td>Domaine d'études</td>";
        echo"<td>Langues</td>";
        echo"<td>Durée d'expérience total</td>";
        echo"<td>Dernier poste</td>";
        echo"</tr>";

        echo"<form method='post' action='consult_parcours_candidat_choisi.php'> ";
        while ($row_recherche=pg_fetch_array($query_recherche))
        {
            echo"<tr>";
            echo"<td><input type='radio'value='$row_recherche[0]' name='id_candidat'>$row_recherche[0]</td> <td>$row_recherche[1]</td><td>$row_recherche[2]</td>";    //ID Nom Prénom
            echo"<td>$row_recherche[3] diplômé(e) en $row_recherche[4]</td>";    //titre diplôme en année
            echo"<td>$row_recherche[5]</td>";   //domaine étude
            echo"<td>$row_recherche[6]</td>";   //langues
            echo"<td>$row_recherche[7]</td>";   //duree_exp_total
            echo"<td>$row_recherche[8]</td>";   //dernier poste
            echo"</tr>";

            echo"<input type='hidden' value=$row_recherche[1] name='nom'>";
            echo"<input type='hidden' value=$row_recherche[2] name='prenom'>";
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

