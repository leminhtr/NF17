<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 5 de la création de votre CV : Expérience porffessionnelle</h1>
  <p>Veuillez répondre à la question pour continuez</p>
<?php
	include 'connect_projet.php';
	$vCon = fConnect();

	$vSE_fr = $_POST['SE_fr'];
	$vSE_en = $_POST['SE_en'];

	$vSQL = "SELECT * FROM Secteur_Activites WHERE DE_fr = '$vSE_fr' AND DE_en = '$vSE_en';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO Secteur_Activites(SE_fr,SE_en) VALUES ('$vSE_fr','$vSE_en');";
		pg_query($vCon,$vSQL);
	}
	
	$vQuery = pg_query($vCon,$vSQL);
	$vResult = pg_fetch_query($vQuery);

	$vdate_d = $_POST['date_debut'];
	$vdate_f = $_POST['date_fin'];
	$vEntpr = $_POST['entreprise'];
	$vId_SE = $vResult['id_SE'];

	$vSQL = "SELECT * FROM Experience_Pro WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND nom_entreprise = '$vEntpr';"
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO Formation(nom_entreprise,date_debut, date_fin, etablissement, secteur_activites) VALUES ('$vEntpré,'$vdate_d','$vdate_f','$Id_SE');";
		pg_query($vCon,$vSQL);
	}

	
	$vQuery = pg_query($vCon,$vSQL);
	$vResult = pg_fetch_query($vQuery)	

	$vId_formation = $vResult['id_formation']
	
	$vtitre1 = $_POST['titre1'];
	$vtype1 = $_POST['type1'];
	$vlangue1 = $_POST['langue1'];
	$vSQL = "SELECT * FROM Formation_traduite WHERE titre = '$vtitre1' AND type = '$vtype1' AND langue = '$vlangue1';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO Formation_traduite(titre,type,langue,id_formation) VALUES ('$vtitre1','$vtype1','$vlangue1','$vId_formation');";
		pg_query($vCon,$vSQL);
	}
	

	$vtitre2 = $_POST['titre2'];
	$vtype2 = $_POST['type2'];
	$vlangue2 = $_POST['langue2'];
	$vSQL = "SELECT * FROM Formation_traduite WHERE titre = '$vtitre2' AND type = '$vtype2' AND langue = '$vlangue2';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO Formation_traduite(titre,type,langue,id_formation) VALUES ('$vtitre2','$vtype2','$vlangue2','$vId_formation');";
		pg_query($vCon,$vSQL);
	}

	$vID = $_SESSION['id'];

	$vSQL = "SELECT * FROM Suivre_Formation WHERE id_candidat = '$vID' AND id_formation = '$vId_formation';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO Suivre_Formation(id_candidat,id_formation) VALUES ('$vID','$vId_formation');";
		pg_query($vCon,$vSQL);
	}

	echo "Voulez vous ajouter d'autres formation ?";
	echo '<p><a href="insert_experience_1.php">Passer à la suite</a></p>';
	echo '</br></br>';
	echo "Si oui, est-elle traduite ?";
	echo '<p><a href="insert_formation_1.php">oui</a></p>';
	echo '<p><a href="insert_formation_2.php">non</a></p>';

?>


<hr/>
</body>
</html>
