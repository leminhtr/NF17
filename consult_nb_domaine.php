<html>
<?php
include 'mise_en_page.html';
?>


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

                
                             ?>
            </td>
        </tr>
    </table>
<br>
    <INPUT TYPE='submit' value='Valider'>
</form>

</body>
</html>
