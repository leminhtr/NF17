<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consulter le nombre de candidats par domaines d'études</title>
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

<h1>Consulter le nombre de candidats connaissant ce domaine d'étude</h1>
<br>
<br>
<br>

<table>
    <tr>
        <th>Domaine</th>
        <th>Nombre de candidat(s)</th>
    </tr>
        <?php

        $domaine=$_POST['domaine']; //récupération var.

        /*Connexion à la BDD*/
        include "connect_projet.php";
        $vConn = fConnect();

        /*======= tableau de la forme : ============
        Domaine     | Nombre de candidats
        $domaine    | nb. candidats ($vquery_result)
        ============================================
        */

        /* Comptage du nombre de candidat de domaine */
        $vSql="SELECT COUNT(*)
                FROM candidats_domaines
                WHERE candidats_domaines.de_fr='$domaine';"; /*comptage candidat*/
        $vQuery=pg_query($vConn, $vSql);

        echo"<tr>";
            echo"<td><center>$domaine</center></td>";           //domaine
            while ($vquery_result=pg_fetch_array($vQuery))
            {
                echo"<td><center>$vquery_result[0]</center></td> "; //nb candidat
            }

        echo"</tr>";
        
                     ?>
    </tr>
</table>