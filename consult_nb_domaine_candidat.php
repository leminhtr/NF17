<html>
<?php
include 'mise_en_page.html';
?>


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
