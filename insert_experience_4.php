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

	$vSQL = "SELECT SA_fr, SA_en FROM Secteurs_Activites WHERE SA_fr = '$vSE_fr' AND SA_en = '$vSE_en';";

	//On regarde si le tuple (SA_fr,SA_en) existe

	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Secteurs_Activites(SA_fr,SA_en) VALUES ('$vSE_fr','$vSE_en');";
		pg_query($vCon,$vSQL2);

	}

	//On recupere l'id_SA

	$vSQL = "SELECT id_SA FROM Secteurs_Activites WHERE SA_fr = '$vSE_fr' AND SA_en = '$vSE_en';";

	$vQuery = pg_query($vCon,$vSQL);

	$vResult = pg_fetch_array($vQuery);

	
	$vEntpr = $_POST['entreprise'];
	$vid_sa = $vResult[id_sa];

	$vSQL = "SELECT secteur_activite, nom_entreprise FROM SecteurEntreprise WHERE secteur_activite = '$vid_sa' AND nom_entreprise = '$vEntpr';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (secteur_activite, nom_entreprise) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO SecteurEntreprise(secteur_activite,nom_entreprise) VALUES ('$vid_sa','$vEntpr');";
		pg_query($vCon,$vSQL2);
	}

	$vdate_d = $_POST['date_debut'];
	$vdate_f = $_POST['date_fin'];

	$vSQL = "SELECT date_debut, date_fin, nom_entreprise FROM Experiences_Pro WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND nom_entreprise = '$vEntpr';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (date_debut, date_fin, nom_entreprise) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Experiences_Pro(nom_entreprise,date_debut, date_fin) VALUES ('$vEntpr','$vdate_d','$vdate_f');";
		pg_query($vCon,$vSQL2);
	}

	//on recupere l'id_exp_pro

	$vSQL = "SELECT id_exp_pro FROM Experiences_Pro WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND nom_entreprise = '$vEntpr';";

	$vQuery = pg_query($vCon,$vSQL);

	$vResult = pg_fetch_array($vQuery);	

	$vid_exp = $vResult[id_exp_pro];
	
	$vfonct1 = $_POST['fonct1'];
	$vSQL = "SELECT * FROM Experiences_Pro_Traduites WHERE id_exp_pro = '$vid_exp' AND fonction = '$vfonct1' AND langue = 'FR';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (id_exp_pro,fonction,'FR') existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Experiences_Pro_Traduites(id_exp_pro,fonction,langue) VALUES ('$vid_exp','$vfonct1','FR');";
		pg_query($vCon,$vSQL2);
	}

	$vfonct2 = $_POST['fonct2'];
	$vSQL = "SELECT * FROM Experiences_Pro_Traduites WHERE id_exp_pro = '$vid_exp' AND fonction = '$vfonct2' AND langue = 'EN';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (id_exp_pro,fonction,'EN') existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Experiences_Pro_Traduites(id_exp_pro,fonction,langue) VALUES ('$vid_exp','$vfonct2','EN');";
		pg_query($vCon,$vSQL2);
	}


	//On recupere l'id du candidat

	$vID = $_SESSION['id_individu'];

	$vSQL = "SELECT * FROM Avoir_Experience WHERE id_candidat = '$vID' AND id_exp_pro = '$vid_exp';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (id_candidat, id_exp_pro) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Avoir_Experience(id_candidat,id_exp_pro) VALUES ('$vID','$vid_exp');";
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
