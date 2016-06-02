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

<h1>Sélectionner un domaine pour consulter le nombre de candidats connaissant ce domaine d'étude</h1>

<br>
<br>
<br>

<form action="consult_nb_domaine_candidat.php" method="POST">
    <table>
        <tr>
            <td><center>Sélectionner un domaine d'étude</center></td>
            <td>
                <?php
                /*Connexion à la BDD*/
                include "connect_projet.php";
                $vConn = fConnect();

                /* Récupération de tous les domaines d'études */
                $vSql="SELECT de_fr, de_en 
                        FROM domaines_etudes;"; /*nom domaine en fr et en*/
                $vQuery=pg_query($vConn, $vSql);

                /*select html du domaine*/
                echo"<select name='domaine' size='1'>";

                    while ($vResult = pg_fetch_array($vQuery))
                    {
                        echo"<OPTION VALUE=".$vResult[0].">".$vResult[0]." | ".$vResult[1]." </OPTION>"; /*"de_fr/de_en"*/
                    }
                echo"</select>";

                pg_close($vConn);
                ?>
            </td>
        </tr>
    </table>
<br>
    <INPUT TYPE='submit' value='Valider'>
</form>

</body>
</html>