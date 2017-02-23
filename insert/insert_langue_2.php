<?php session_start(); /*Permet de passer de page en page l'identifiant artificiel du candidat créant son CV*/?>

<html>
<?php
include 'mise_en_page.html';
?>
  <h1>Etape 3 de la création de votre CV : langues parlées</h1>

<?php
	/*Concetion à la base de donnée*/
	include "connect_projet.php";
	$vConn = fConnect();

	/*Récupération de l'identifiant du candidat conservé dans la session*/
	$vid_individu = $_SESSION['id_individu'];

	/*Récupération des variables passées en formulaire*/
	$vfr = $_POST['francais'];
	$van = $_POST['anglais'];
	$ves = $_POST['espagnol'];
	$val = $_POST['allemand'];

	/*Requêtes permettant de rajouter le niveau qu'un candidat a pour chacune des langues existantes dans la base. En effet un candidat ne peut pas ajouter une langue qui n'a pas été préalablement ajoutée dans la base */
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

