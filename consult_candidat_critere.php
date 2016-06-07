<!DOCTYPE html>
<html>
<?php
include 'mise_en_page.html';
?>

<h1>Rechercher les candidats qui correspondent à vos critères</h1>

<br>
<br>
<br>


<form method="POST" action="consult_candidat_critere_choix.php">
    <table>

            <?php
            /*Connexion à la BDD*/
            include "connect_projet.php";
            $vConn = fConnect();

            echo"<tr>";
            echo"<th>Formations</th>";
            echo"</tr>";

            echo"<tr>";
            echo"<td><center>Domaine d'étude<br><i>(Vous pouvez sélectionner<br>plusieurs domaines<br>avec ctrl+gauche)</i></center></td>";

            $query_sql_domaine="SELECT de.de_fr, de.de_en
                                FROM domaines_etudes de;";
            $query_domaine=pg_query($vConn,$query_sql_domaine);

            echo"<td>";
            //SELECT MULTIPLE DOMAINE
            echo"<select multiple name='domaine[]'>";
            while ($row_domaine=pg_fetch_array($query_domaine))
            {

                echo"<option value='$row_domaine[0]'>$row_domaine[0] $row_domaine[1]</option>";
            }
            echo"</select>";
            echo"</td>";

            echo"</tr>";
            ?>


        <tr>
            <th>Expérience</th>
        </tr>
            <tr>
            <td>Nombre d'expérience professionnelle</td>
            <td><input type="text" name="nb_exp"></td>
            <tr>
            <td rowspan="4"><center>Durée d'expérience</center></td>
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
            <th>Langues</th>
        <tr>
            <?php
            /*Connexion à la BDD*/
            //include "connect_projet.php";
            //$vConn = fConnect();

            echo"<td><center>Langue(s) parlée(s)<br><i>(Vous pouvez sélectionner<br>plusieurs langues)</i></center></td>";

            $query_sql_langue="SELECT l.nom_fr, l.nom_en
                                FROM langues l;";
            $query_langue=pg_query($vConn,$query_sql_langue);

            echo"<td>";
            //SELECT MULTIPLE LANGUE
            echo"<select multiple name='langue[]'>";
            while ($row_langue=pg_fetch_array($query_langue))
            {
                echo"<option value='$row_langue[0]'>$row_langue[0] $row_langue[1]</option>";
            }
            echo"</select>";
            echo"</td>";
           
            ?>
        </tr>
        <tr></tr>
        <tr><td><input type="submit" value="Valider"></td></tr>

    </table>
</form>

</body>
</html>