<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 5 de la création de votre CV : Formation</h1>
  <p>Veuillez répondre à la question pour continuez</p>
<?php
	include 'connect_projet.php';
	$vCon = fConnect();

	$vDE_fr = $_POST['DE_fr'];
	$vDE_en = $_POST['DE_en'];

	$vSQL = "SELECT * FROM Domaines_Etudes WHERE DE_fr = '$vDE_fr' AND DE_en = '$vDE_en';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Domaines_Etudes(DE_fr,DE_en) VALUES ('$vDE_fr','$vDE_en');";
		pg_query($vCon,$vSQL2);
		$vQuery = pg_query($vCon,$vSQL);
	}
	
	$vResult = pg_fetch_array($vQuery);

	$vdate_d = $_POST['date_debut'];
	$vdate_f = $_POST['date_fin'];
	$vEtab = $_POST['etablissement'];
	$vPays = $_POST['pays'];
	$vVille = $_POST['ville'];
	$vId_DE = $vResult[id_de];

	$vSQL = "SELECT * FROM Formations WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND etablissement = '$vEtab';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Formations(date_debut, date_fin, etablissement, pays, ville, domaine_etude) VALUES ('$vdate_d','$vdate_f', '$vEtab', '$vPays', '$vVille', '$vId_DE');";
		pg_query($vCon,$vSQL2);
		$vQuery = pg_query($vCon,$vSQL);
	}

	
	$vResult = pg_fetch_array($vQuery);	

	$vId_formation = $vResult[id_formation];
	
	$vtitre1 = $_POST['titre1'];
	$vtype1 = $_POST['type1'];
	$vlangue1 = $_POST['langue1'];
	$vSQL = "SELECT * FROM Formations_Traduites WHERE titre = '$vtitre1' AND type = '$vtype1' AND langue = '$vlangue1' AND id_formation = '$vId_formation';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Formations_Traduites(titre,type,langue,id_formation) VALUES ('$vtitre1','$vtype1','$vlangue1','$vId_formation');";
		pg_query($vCon,$vSQL2);
	}
	

	$vtitre2 = $_POST['titre2'];
	$vtype2 = $_POST['type2'];
	$vlangue2 = $_POST['langue2'];
	$vSQL = "SELECT * FROM Formations_Traduites WHERE titre = '$vtitre2' AND type = '$vtype2' AND langue = '$vlangue2' AND id_formation = '$vId_formation';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Formations_Traduites(titre,type,langue,id_formation) VALUES ('$vtitre2','$vtype2','$vlangue2','$vId_formation');";
		pg_query($vCon,$vSQL2);
	}

	$vID = $_SESSION['id_individu'];

	$vSQL = "SELECT * FROM Suivre_Formation WHERE id_candidat = '$vID' AND id_formation = '$vId_formation';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Suivre_Formation(id_candidat,id_formation) VALUES ('$vID','$vId_formation');";
		pg_query($vCon,$vSQL2);
	}

	echo "Voulez vous ajouter d'autres formation ?";
	echo '<p><a href="insert_experience_1.php">Passer à la suite</a></p>';
	echo '</br></br>';
	echo "Si oui, est-elle traduite ?";
	echo '<p><a href="insert_formation_2.php">oui</a></p>';
	echo '<p><a href="insert_formation_3.php">non</a></p>';

?>


<hr/>
</body>
</html>
