<html>
<?php
include 'mise_en_page.html';

?>
	<h1>Etape 4 de la création de votre CV : choix d'un référent</h1>
	<h3>Veuillez choisir un référent en saisissant son indentifiant, vous aurez ensuite accès à son email afin de le contacter </h3></br></br>
	<table border="1">
	<tr><th>Identifiant</th><th>Nom du référent</th><th>Situation profesionnelle</th><th>employeur</th></tr>

<?php
	include "connect_projet.php";
	$vConn = fConnect();
	$vSql ="SELECT R.id_referent, I.nom, R.situation_pro, R.employeur FROM Referents R, Individus I WHERE R.id_referent = I.id_individu;";
	$vQuery=pg_query($vConn, $vSql);
	while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
		echo "<tr>";

		echo "<td>$vResult[0]</td>";
		echo "<td>$vResult[1]</td>";
		echo "<td>$vResult[2]</td>";
		echo "<td>$vResult[3]</td>";
		echo "</tr>";}

?>

<form method= "post" action="insert_referent_2.php">
	<label>Identifiant du référent souhaité</label> : <input type="int" name="id" required/>
	</br></br>
	<input type="submit" value="valider" />
    	</p>
</form>
