<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 4 de la création de votre CV : Compétence</h1>
<?php
	include 'connect_projet.php';
	$vCompt = $_POST['nom'];
	$vLang = $_POST['langue'];
	$vCon = fConnect();


	$vSQL = "SELECT nom, langue FROM Competences WHERE nom = '$vCompt' AND langue = '$vLang';";
	$vQuery = pg_query($vCon,$vSQL);

	//On teste si le tuple (nom, langue) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL = "INSERT INTO Competences(nom,langue) VALUES ('$vCompt','$vLang');";
		pg_query($vCon,$vSQL);
	}

	
	//On recupere l'id du candidat

	$vID = $_SESSION['id_individu'];
	
	$vSQL = "SELECT id_candidat, nom, langue FROM Posseder_Competence WHERE nom = '$vCompt' AND langue = '$vLang';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (id_candidat, nom, langue)

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

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
