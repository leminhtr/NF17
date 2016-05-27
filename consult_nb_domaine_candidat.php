<html>
<head>
    <meta charset="UTF-8">
    <title>Consulter le nombre de candidats par domaines d'études</title>
</head>
<body>

<h1>Consulter le nombre de candidats connaissant ce domaine d'étude</h1>
<br>
<br>
<br>

<table>
    <tr>
        <td>Domaine</td>
        <td>Nombre de candidats</td>
    </tr>
        <?php

        $domaine=$_POST['domaine'];

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
                FROM candidats_competences
                WHERE candidats_competences.de_fr='$domaine';"; /*comptage candidat*/
        $vQuery=pg_query($vConn, $vSql);

        echo"<tr>";
            echo"<td>$domaine</td>";
            while ($vquery_result=pg_fetch_array($vQuery))
            {
                echo"<td><center>$vquery_result[0]</center></td> ";
            }

        echo"</tr>";

        ?>
    </tr>
</table>