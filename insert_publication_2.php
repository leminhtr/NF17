<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 8 de la création de votre CV : Publications</h1>
<?php
	include 'connect_projet.php';
	$vIsbn = $_POST['isbn'];
	$vTitre = $_POST['titre'];
	$vDate = $_POST['date'];
	$vCont = $_POST['cont'];
	$vCon = fConnect();

	$vSQL = "SELECT ISBN, date FROM DatePublication WHERE ISBN = '$vIsbn' AND date = '$vDate';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (ISBN,date) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL = "INSERT INTO DatePublication(ISBN,date) VALUES ('$vIsbn','$vDate');";
		pg_query($vCon,$vSQL);
	}


	//On recupere l'id_date_pub

	$vSQL = "SELECT id_date_pub FROM DatePublication WHERE ISBN = '$vIsbn' AND date = '$vDate';";

	$vQuery = pg_query($vCon,$vSQL);

	$vResult = pg_fetch_array($vQuery, NULL, PGSQL_ASSOC);
	$vid_date = $vResult[id_date_pub];


	$vSQL = "SELECT titre, id_date_pub, contenu FROM Publications WHERE titre = '$vTitre' AND id_date_pub = '$vid_date' AND contenu = '$vCont';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (titre, id_date_pub, contenu) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//s'il n'existe pas, on le creer

		$vSQL = "INSERT INTO Publications(titre,id_date_pub,contenu) VALUES ('$vTitre','$vid_date','$vCont');";
		pg_query($vCon,$vSQL);
	}

	//On recupere l'id_pub

	$vSQL = "SELECT id_pub FROM Publications WHERE titre = '$vTitre' AND id_date_pub = '$vid_date' AND contenu = '$vCont';";
	$vQuery = pg_query($vCon,$vSQL);

	$vResult = pg_fetch_array($vQuery, NULL, PGSQL_ASSOC);
	$vid_pub = $vResult[id_pub];

	//On recupere l'id du candidat

	$vID = $_SESSION['id_individu'];

	$vSQL = "SELECT id_candidat, id_publication FROM Ecrire_Publication WHERE id_candidat = '$vID' AND id_publication = '$vid_pub';";
	$vQuery = pg_query($vCon,$vSQL);

	//On regarde si le tuple (id_candidat,id_publication) existe

	if(pg_fetch_array($vQuery, NULL, PGSQL_ASSOC) == NULL){

		//S'il n'existe pas, on le creer

		$vSQL = "INSERT INTO Ecrire_Publication(id_candidat,id_publication) VALUES ('$vID','$vid_pub');";
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
