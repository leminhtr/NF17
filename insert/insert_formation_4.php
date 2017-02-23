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

	$vSQL = "SELECT DE_fr, DE_en FROM Domaines_Etudes WHERE DE_fr = '$vDE_fr' AND DE_en = '$vDE_en';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (DE_fr, DE_en) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas on le creer

		$vSQL2 = "INSERT INTO Domaines_Etudes(DE_fr,DE_en) VALUES ('$vDE_fr','$vDE_en');";
		pg_query($vCon,$vSQL2);
	}

	//On recupere l'id (cle artificielle) du tuple

	$vSQL = "SELECT id_DE FROM Domaines_Etudes WHERE DE_fr = '$vDE_fr' AND DE_en = '$vDE_en';";

	$vQuery = pg_query($vCon,$vSQL);	

	$vResult = pg_fetch_array($vQuery);

	$vdate_d = $_POST['date_debut'];
	$vdate_f = $_POST['date_fin'];
	$vEtab = $_POST['etablissement'];
	$vPays = $_POST['pays'];
	$vVille = $_POST['ville'];
	$vid_DE = $vResult[id_de];

	$vSQL = "SELECT date_debut, date_fin, etablissement FROM Formations WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND etablissement = '$vEtab';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (date_debut, date_fin, etablissement) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Formations(date_debut, date_fin, etablissement, pays, ville, domaine_etude) VALUES ('$vdate_d','$vdate_f', '$vEtab', '$vPays', '$vVille', '$vid_DE');";
		pg_query($vCon,$vSQL2);
	}

	//On recupere l'id (cle artificielle) du tuple

	$vSQL = "SELECT id_formation FROM Formations WHERE date_debut = '$vdate_d' AND date_fin = '$vdate_f' AND etablissement = '$vEtab';";

	$vQuery = pg_query($vCon,$vSQL);
	
	$vResult = pg_fetch_array($vQuery);	

	$vid_formation = $vResult[id_formation];
	
	$vtitre1 = $_POST['titre1'];
	$vtype1 = $_POST['type1'];

	$vSQL = "SELECT * FROM Formations_Traduites WHERE titre = '$vtitre1' AND type = '$vtype1' AND langue = 'FR' AND id_formation = '$vid_formation';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (titre,type,'FR',id_formation) existe 

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Formations_Traduites(titre,type,langue,id_formation) VALUES ('$vtitre1','$vtype1','FR','$vid_formation');";
		pg_query($vCon,$vSQL2);
	}
	

	$vtitre2 = $_POST['titre2'];
	$vtype2 = $_POST['type2'];

	$vSQL = "SELECT * FROM Formations_Traduites WHERE titre = '$vtitre2' AND type = '$vtype2' AND langue = 'EN' AND id_formation = '$vid_formation';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (titre,type,'EN',id_formation) existe 

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL2 = "INSERT INTO Formations_Traduites(titre,type,langue,id_formation) VALUES ('$vtitre2','$vtype2','EN','$vid_formation');";
		pg_query($vCon,$vSQL2);
	}

	//on recupere l'id du candidat

	$vID = $_SESSION['id_individu'];

	$vSQL = "SELECT * FROM Suivre_Formation WHERE id_candidat = '$vID' AND id_formation = '$vid_formation';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (id_candidat,id_formation) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il existe pas, on le creer

		$vSQL2 = "INSERT INTO Suivre_Formation(id_candidat,id_formation) VALUES ('$vID','$vid_formation');";
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
