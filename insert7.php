<?php session_start();?>
<html>
<?php
include 'mise_en_page.php';
?>
<h1>Etape 4 de la création de votre CV : Formation</h1>
  <p>Veuillez remplir les champs ci-dessous</p>
<?php
	include 'connect_projet.php';
	$vCompt = $_POST['Compt'];
	$vLang = $_POST['Langue'];
	$vCon = fConnect();

	$vSQL = "SELECT nom, langue FROM Competences WHERE nom = $vCompt AND langue = $vLang";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_query($vQuery) == NULL){
		$vSQL = "INSERT INTO Competences(nom,langue) VALUES ($vCompt,$vLang)";
		pg_query($vCon,$vSQL);
	}

	
	//-> récuperer l'id du candidat !!!

	$vID = $_SESSION['id'];
	
	$vSQL = "SELECT id, nom, langue FROM Posseder_Competence WHERE nom = $vCompt AND langue = $vLang";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_query($vQuery) == NULL){
		$vSQL = "INSERT INTO Posseder_Competence(id_candidat,nom,langue) VALUES ($vID,$vCompt,$vLang)";
		pg_query($vCon,$vSQL);
	}


	echo "La formation que vous voulez insérer est elle traduite ?";
	echo '<p><a href="insert8.php">Oui</a></p>';
	echo '<p><a href="insert9.php">Non</a></p>';

?>


?>

<hr/>
</body>
</html>
