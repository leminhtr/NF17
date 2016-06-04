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


<form method="POST" action="consult_parcours_candidat.php">
    <table>
        <tr>
            <?php
            /*Connexion à la BDD*/
            include "connect_projet.php";
            $vConn = fConnect();

            echo"<th>Domaine d'étude<br><i>(Vous pouvez sélectionner<br>plusieurs domaines<br>avec ctrl+gauche)</i></th>";

            $query_sql_domaine="SELECT de.de_fr, de.de_en
                                FROM domaines_etudes de;";
            $query_domaine=pg_query($vConn,$query_sql_domaine);

            echo"<td>";
            //SELECT MULTIPLE DOMAINE
            echo"<select multiple name='domaine'>";
            while ($row_domaine=pg_fetch_array($query_domaine))
            {

                echo"<option value='$row_domaine[0]'>$row_domaine[0] $row_domaine[1]</option>";

            }
            echo"</select>";
            echo"</td>";

            pg_close($vConn);
            ?>
        </tr>

        <tr>
            <th>Expérience</th>
        </tr>
            <tr>
            <td>Nombre d'expérience professionnelle</td>
            <td><input type="text" name="nb_exp"></td>
            <tr>
            <td rowspan="4">Durée d'expérience</td>
            <td><input type="radio" value="365" name="duree_exp">Moins d'1 an</td>
            </tr>
            <tr>
            <td><input type="radio" value="1095" name="duree_exp">1 à 3 ans</td>
            </tr>
            <tr>
            <td><input type="radio" value="1825" name="duree_exp">3 à 5 ans</td>
            </tr>
            <tr>
            <td><input type="radio" value="1826" name="duree_exp">Plus de 5 ans</td>
            </tr>
        <tr>
            <th>Langue</th>
        <tr>
            <?php
            /*Connexion à la BDD*/
            include "connect_projet.php";
            $vConn = fConnect();

            echo"<th>Langue(s) parlée(s)<br><i>(Vous pouvez sélectionner<br>plusieurs langue)</i></th>";

            $query_sql_langue="SELECT l.nom_fr, l.nom_en
                                FROM langues l;";
            $query_langue=pg_query($vConn,$query_sql_langue);

            echo"<td>";
            //SELECT MULTIPLE LANGUE
            echo"<select multiple name='langue'>";
            while ($row_langue=pg_fetch_array($query_langue))
            {
                echo"<option value='$row_langue[0]'>$row_langue[0] $row_langue[1]</option>";
            }
            echo"</select>";
            echo"</td>";
            pg_close($vConn);
            ?>
        </tr>



        <tr></tr>
        <tr><td><input type="submit" value="Valider"></td></tr>

    </table>
</form>