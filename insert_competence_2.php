<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 3 de la création de votre CV : Compétence</h1>
<?php
	include 'connect_projet.php';
	$vCompt = $_POST['nom'];
	$vLang = $_POST['langue'];
	$vCon = fConnect();

	$vSQL = "SELECT nom, langue FROM Competences WHERE nom = '$vCompt' AND langue = '$vLang';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO Competences(nom,langue) VALUES ('$vCompt','$vLang');";
		pg_query($vCon,$vSQL);
	}

	
	//-> récuperer l'id du candidat !!!

	$vID = $_SESSION['id'];
	
	$vSQL = "SELECT id_candidat, nom, langue FROM Posseder_Competence WHERE nom = '$vCompt' AND langue = '$vLang';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO Posseder_Competence(id_candidat,nom,langue) VALUES ('$vID','$vCompt','$vLang');";
		pg_query($vCon,$vSQL);
	}

	echo "Voulez vous ajouter d'autres compétence ?";
	echo '<p><a href="insert_competence_1.php">Ajouter une autre compétence</a></p>';
	echo '</br></br>';
	echo "Continuez ?";
	echo '<p><a href="insert_formation_1.php">Ajouter des formations</a></p>';

?>
<hr/>

</body>
</html>
