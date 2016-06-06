<?php session_start(); ?>

<html>
<?php
include 'mise_en_page.html';
?>
  <h1>Etape 3 de la création de votre CV : langues parlées</h1>

<?php
	include "connect_projet.php";
	$vConn = fConnect();
	$vid_individu = $_SESSION['id_individu'];
	$vfr = $_POST['francais'];
	$van = $_POST['anglais'];
	$ves = $_POST['espagnol'];
	$val = $_POST['allemand'];

	$vSql = "INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES ('$vid_individu', 1, '$vfr')";
	pg_query($vConn, $vSql);

	$vSql = "INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES ('$vid_individu', 2, '$van')";
	pg_query($vConn, $vSql);

	$vSql = "INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES ('$vid_individu', 3, '$ves')";
	pg_query($vConn, $vSql);

	$vSql = "INSERT INTO Parler_Langue (id_candidat, id_langue, niveau_langue) VALUES ('$vid_individu', 4, '$val')";
	pg_query($vConn, $vSql);

	echo '<p><a href="insert_referent_1.php">Continuer</a></p>';

?>

