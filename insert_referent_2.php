<?php session_start(); ?>

<html>
<?php
include 'mise_en_page.html';
?>

<h1>Etape 4 de la création de votre CV : choix d'un référent</h1>

<?php
	include "connect_projet.php";
	$vConn = fConnect();
	$vid_individu = $_SESSION['id_individu'];
	$vid_referent = $_POST['id'];

	$vSql = "INSERT INTO Posseder_Referent (id_candidat, id_referent) VALUES ('$vid_individu', '$vid_referent')";
	pg_query($vConn, $vSql);
?>

<?php

	$vSql ="SELECT id_candidat, id_referent FROM Posseder_Referent;";
	$vQuery=pg_query($vConn, $vSql);
	while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
		echo "<tr>";

		echo "<td>$vResult[0]</td>";
		echo "<td>$vResult[1]</td>";

		echo "</tr>";}

	$_SESSION['i'] = 1; //Variable qui pourra itérer le nombre de Compétence
	$_SESSION['j'] = 1; //Variable qui pourra itérer le nombre de Formation
	
	echo '<p><a href="insert5.php">Continuer</a></p>';

	

?>

