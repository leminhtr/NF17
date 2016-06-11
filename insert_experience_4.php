<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 6 de la création de votre CV : Expérience proffessionnelle</h1>
  <p>Veuillez répondre à la question pour continuez</p>
<?php
	include 'connect_projet.php';
	$vCon = fConnect();

	$vSE_fr = $_POST['SE_fr'];
	$vSE_en = $_POST['SE_en'];

	$vSQL = "SELECT * FROM Secteurs_Activites WHERE SA_fr = '$vSE_fr' AND SA_en = '$vSE_en';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Secteurs_Activites(SA_fr,SA_en) VALUES ('$vSE_fr','$vSE_en');";
		pg_query($vCon,$vSQL2);
		$vQuery = pg_query($vCon,$vSQL);
	}
	

	$vResult = pg_fetch_array($vQuery);

	
	$vEntpr = $_POST['entreprise'];
	$vId_SA = $vResult[id_sa];

	$vSQL = "SELECT * FROM SecteurEntreprise WHERE secteur_activite = '$vId_SA' AND nom_entreprise = '$vEntpr';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO SecteurEntreprise(id_SE,nom_entreprise) VALUES ('$vId_SA','$vEntpr');";
		pg_query($vCon,$vSQL2);
	}

	$vdate_d = $_POST['date_debut'];
	$vdate_f = $_POST['date_fin'];

	$vSQL = "SELECT * FROM Experiences_Pro WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND nom_entreprise = '$vEntpr';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Experiences_Pro(nom_entreprise,date_debut, date_fin) VALUES ('$vEntpr','$vdate_d','$vdate_f');";
		pg_query($vCon,$vSQL2);
		$vQuery = pg_query($vCon,$vSQL);
	}

	

	$vResult = pg_fetch_array($vQuery);	

	$vId_exp = $vResult['id_exp_pro'];
	
	$vtitre1 = $_POST['titre1'];
	$vfonct1 = $_POST['fonct1'];
	$vlangue1 = $_POST['langue1'];
	$vSQL = "SELECT * FROM Experiences_Pro_Traduites WHERE fonction = '$vfonct1' AND langue = '$vlangue1';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Experiences_Pro_Traduites(fonction,langue) VALUES ('$vfonct1','$vlangue1');";
		pg_query($vCon,$vSQL2);
	}

$vtitre1 = $_POST['titre2'];
	$vfonct2 = $_POST['fonct2'];
	$vlangue2 = $_POST['langue2'];
	$vSQL = "SELECT * FROM Experiences_Pro_Traduites WHERE fonction = '$vfonct2' AND langue = '$vlangue2';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Experiences_Pro_Traduites(fonction,langue) VALUES ('$vfonct2','$vlangue2');";
		pg_query($vCon,$vSQL2);
	}
	



	$vID = $_SESSION['id_individu'];

	$vSQL = "SELECT * FROM Avoir_Experience WHERE id_candidat = '$vID' AND id_exp_pro = '$vId_exp';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Avoir_Experience(id_candidat,id_exp_pro) VALUES ('$vID','$vId_exp');";
		pg_query($vCon,$vSQL2);
	}

	echo "Voulez vous ajouter d'autres formation ?";
	echo '<p><a href="insert_association_1.php">Passer à la suite</a></p>';
	echo '</br></br>';
	echo "Si oui, est-elle traduite ?";
	echo '<p><a href="insert_experience_2.php">oui</a></p>';
	echo '<p><a href="insert_experience_3.php">non</a></p>';

?>


<hr/>
</body>
</html>
