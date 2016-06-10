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
		$vSQL2 = "INSERT INTO Secteur_Activites(SE_fr,SE_en) VALUES ('$vSE_fr','$vSE_en');";
		pg_query($vCon,$vSQL2);
		$vQuery = pg_query($vCon,$vSQL);
	}
	

	$vResult = pg_fetch_query($vQuery);

	
	$vEntpr = $_POST['entreprise'];
	$vId_SE = $vResult['id_SE'];

	$vSQL = "SELECT * FROM SecteurEntreprise WHERE id_SE = '$vId_SE' AND nom_entreprise = '$vEntpr';"
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO SecteurEntreprise(id_SE,nom_entreprise,) VALUES ('$vEntpr''$Id_SE');";
		pg_query($vCon,$vSQL2);
	}

	$vdate_d = $_POST['date_debut'];
	$vdate_f = $_POST['date_fin'];

	$vSQL = "SELECT * FROM Experience_Pro WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND nom_entreprise = '$vEntpr';"
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Formation(nom_entreprise,date_debut, date_fin, etablissement) VALUES ('$vEntpr','$vdate_d','$vdate_f');";
		pg_query($vCon,$vSQL2);
		$vQuery = pg_query($vCon,$vSQL);
	}

	

	$vResult = pg_fetch_query($vQuery)	

	$vId_exp = $vResult['id_exp_pro']
	
	$vtitre1 = $_POST['titre1'];
	$vfonct1 = $_POST['fonct1'];
	$vlangue1 = $_POST['langue1'];
	$vSQL = "SELECT * FROM Ecperiences_Pro_Traduites WHERE titre_poste = '$vtitre1' AND fonction = '$vfonct1' AND langue = '$vlangue1';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Formation_traduite(titre_poste,fonction,langue,id_exp) VALUES ('$vtitre1','$vfonct1','$vlangue1','$vId_exp');";
		pg_query($vCon,$vSQL2);
	}
	



	$vID = $_SESSION['id'];

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
	echo '<p><a href="insert_experience_1.php">oui</a></p>';
	echo '<p><a href="insert_experience_2.php">non</a></p>';

?>


<hr/>
</body>
</html>
