x<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 7 de la création de votre CV : Associations</h1>
  <p>Veuillez répondre à la question pour continuez</p>
<?php
	include 'connect_projet.php';
	$vCon = fConnect();

	$vstatut_fr = $_POST['statut_fr'];
	$vstatut_en = $_POST['statut_en'];

	$vSQL = "SELECT statut_fr, statut_en FROM Status WHERE statut_fr = '$vstatut_fr' AND statut_en = '$vstatut_en';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (statut_fr, statut_en) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'exite pas, on le creer

		$vSQL2 = "INSERT INTO Status(statut_fr,statut_en) VALUES ('$vstatut_fr','$vstatut_en');";
		pg_query($vCon,$vSQL2);
	}

	//On recupere l'id_statut

	$vSQL = "SELECT id_statut FROM Status WHERE statut_fr = '$vstatut_fr' AND statut_en = '$vstatut_en';";

	$vQuery = pg_query($vCon,$vSQL);
	
	$vResult = pg_fetch_array($vQuery);

	$vNom = $_POST['nom'];
	$vdate_d = $_POST['date_debut'];
	$vdate_f = $_POST['date_fin'];
	$vid_statut = $vResult[id_statut];


	$vSQL = "SELECT date_debut, date_fin, nom_asso FROM Postes_Associations WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND nom_asso = '$vNom';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (date_debut, date_fin, nom_asso) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il existe pas, on le creer

		$vSQL2 = "INSERT INTO Postes_Associations(nom_asso, date_debut, date_fin, statut) VALUES ('$vNom','$vdate_d','$vdate_f', '$vid_statut');";
		pg_query($vCon,$vSQL2);
	}

	//On recupere l'id_asso


	$vSQL = "SELECT id_asso FROM Postes_Associations WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND nom_asso = '$vNom';";

	$vQuery = pg_query($vCon,$vSQL);

	
	$vResult = pg_fetch_array($vQuery);

	$vid_asso = $vResult[id_asso];
	
	$vDesc1 = $_POST['description1'];
	$vlangue1 = $_POST['langue1'];
	$vSQL = "SELECT * FROM Postes_Associations_Traduits WHERE id_asso = '$vid_asso' AND description = '$vDesc1' AND langue = '$vlangue1';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (id_asso, description, 'lanque') existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'Il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Postes_Associations_Traduits(description,langue,id_asso) VALUES ('$vDesc1','$vlangue1','$vid_asso');";
		pg_query($vCon,$vSQL2);
	}
	
	// On recupere l'id du candidat

	$vID = $_SESSION['id_individu'];

	$vSQL = "SELECT * FROM Participer_Association WHERE id_candidat = '$vID' AND id_asso = '$vid_asso';";

	//On regarde si le tuple (id_candidat,id_asso) existe

	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Participer_Association(id_candidat,id_asso) VALUES ('$vID','$vid_asso');";
		pg_query($vCon,$vSQL2);
	}

	echo "Voulez vous ajouter d'autres formation ?";
	echo '<p><a href="insert_publication_1.php">Passer à la suite</a></p>';
	echo '</br></br>';
	echo "Si oui, est-elle traduite ?";
	echo '<p><a href="insert_association_2.php">oui</a></p>';
	echo '<p><a href="insert_association_3.php">non</a></p>';

?>


<hr/>
</body>
</html>
