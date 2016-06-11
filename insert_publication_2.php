<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 4 de la création de votre CV : Compétence</h1>
<?php
	include 'connect_projet.php';
	$vIsbn = $_POST['isbn'];
	$vTitre = $_POST['titre'];
	$vDate = $_POST['date']
	$vCont = $_POST['cont'];
	$vCon = fConnect();

	$vSQL = "SELECT * FROM DatePublication WHERE ISBN = '$vIsbn' AND date = '$vDate';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO DatePublication(ISBN,date) VALUES ('$vIsbn','$vDate');";
		pg_query($vCon,$vSQL);
		$vQuery = pg_query($vCon,$vSQL);
	}

	$vResult = pg_fetch_array($vQuery, NULL, PGSQL_ASSOC);
	$vId_date = $vResult[id_date_pub];


	$vSQL = "SELECT * FROM Publications WHERE titre = '$vTitre' AND id_date_pub = '$vId_date' AND contenu = '$vCont';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO Publications(titre,id_date_pub,contenu) VALUES ('$vTitre','$vId_date','$vCont');";
		pg_query($vCon,$vSQL);
		$vQuery = pg_query($vCon,$vSQL);
	}


	$vResult = pg_fetch_array($vQuery, NULL, PGSQL_ASSOC);
	$vId_pub = $vResult[id_pub];

	//-> récuperer l'id du candidat !!!

	$vID = $_SESSION['id_individu'];

	$vSQL = "SELECT id_candidat, id_publication FROM Ecrire_Publication WHERE id_candidat = '$vID' AND id_publication = '$vId_pub';";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){
		$vSQL = "INSERT INTO Ecrire_Publication(id_candidat,id_publication) VALUES ('$vID','$vId_pub');";
		pg_query($vCon,$vSQL);
	}

	echo "Voulez vous ajouter d'autres publications ?";
	echo '<p><a href="insert_publication_1.php">Ajouter une autre publication</a></p>';
	echo '</br></br>';
	echo "Continuez ?";
	echo '<p><a href="insert_fin.php">Terminer</a></p>';

?>
<hr/>

</body>
</html>
