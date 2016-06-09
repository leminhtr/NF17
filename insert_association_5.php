<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 6 de la création de votre CV : Associations</h1>
  <p>Veuillez répondre à la question pour continuez</p>
<?php
	include 'connect_projet.php';
	$vCon = fConnect();

	$vstatut_fr = $_POST['statut_fr'];
	$vstatut_en = $_POST['statut_en'];

	$vSQL = "SELECT * FROM Status WHERE statut_fr = '$vstatut_fr' AND statut_en = '$vstatut_en';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Status(statut_fr,statut_en) VALUES ('$vstatut_fr','$vstatut_en');";
		pg_query($vCon,$vSQL2);
		$vQuery = pg_query($vCon,$vSQL);
	}
	
	$vResult = pg_fetch_query($vQuery);

	$vNom = $_POST['nom']
	$vdate_d = $_POST['date_debut'];
	$vdate_f = $_POST['date_fin'];
	$vId_statut = $vResult['id_statut'];

	$vSQL = "SELECT * FROM Postes_Associations WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND nom_asso = '$vNom';"
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Postes_Associations(nom_asso, date_debut, date_fin, statut) VALUES ('$vNom','$vdate_d','$vdate_f', '$Id_statut');";
		pg_query($vCon,$vSQL2);
		$vQuery = pg_query($vCon,$vSQL);
	}

	
	$vResult = pg_fetch_query($vQuery)	

	$vId_asso = $vResult['id_asso']
	
	$vDesc1 = $_POST['description1'];
	$vlangue1 = $_POST['langue1'];
	$vSQL = "SELECT * FROM Postes_Associations_traduite WHERE id_asso = '$vId_asso' AND type = '$vtype1' AND langue = '$vlangue1';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Formation_traduite(description,langue,id_asso) VALUES ('$vDesc1','$vlangue1','$vId_asso');";
		pg_query($vCon,$vSQL2);
	}
	

	$vID = $_SESSION['id'];

	$vSQL = "SELECT * FROM Participer_Association WHERE id_candidat = '$vID' AND id_asso = '$vId_asso';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL2 = "INSERT INTO Participer_Association(id_candidat,id_asso) VALUES ('$vID','$vId_asso');";
		pg_query($vCon,$vSQL2);
	}

	echo "Voulez vous ajouter d'autres formation ?";
	//echo '<p><a href="insert_experience_1.php">Passer à la suite</a></p>';
	echo '</br></br>';
	echo "Si oui, est-elle traduite ?";
	echo '<p><a href="insert_association_1.php">oui</a></p>';
	echo '<p><a href="insert_association_2.php">non</a></p>';

?>


<hr/>
</body>
</html>
