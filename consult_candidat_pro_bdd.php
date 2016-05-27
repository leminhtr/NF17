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

<table>
    <tr>
        <td>Nom</td>
        <td>Prénom</td>
        <td>Mail</td>
        <td>Téléphone</td>
        <td>Site web</td>
    </tr>

    <tr>
        <?php
            echo"<tr>"; //ligne 2 tableau
                echo"<td>     </td>";   //faire affichage requete



            echo"</tr>";

            echo"<tr>";




            echo"</tr>";


        ?>


    </tr>




</table>