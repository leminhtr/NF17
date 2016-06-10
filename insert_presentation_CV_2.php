<?php session_start(); /*Permet de passer de page en page l'identifiant artificiel du candidat créant son CV*/?>

<html>
<?php
include 'mise_en_page.html';
?>
  <h1>Etape 2 de la création de votre CV : informations principales de votre CV</h1>

<?php
	/*Concetion à la base de donnée*/
	include "connect_projet.php";
	$vConn = fConnect();

	/*Récupération de l'identifiant du candidat conservé dans la session*/
	$vid_individu = $_SESSION['id_individu'];

	/*Récupération des variables passées en formulaire*/
	$sstatut=$_POST['statut'];
	$vlangue1=$_POST['langue1'];
	$vtitre1=$_POST['titre1'];
	$vinfo1=$_POST['infos_complementaires1'];
	$vlangue2=$_POST['langue2'];
	$vtitre2=$_POST['titre2'];
	$vinfo2=$_POST['infos_complementaires2'];



	/*Commencement d'une transaction afin d'être sur de ne pas avoir de problème de cohérance dans le cas ou deux candidats créent leur CV en même temps*/
	pg_query($vConn, "BEGIN TRANSACTION");
		
	/*Création du nouveau CV avec les dates du jour. On ne s'occupe pas de créer l'identifiant artificiel, le type SERIAL de la table s'incrémente automatiquement*/
	$vSql = "INSERT INTO CV (candidat, statut, date_creation, date_maj) VALUES ('$vid_individu', '$sstatut', NOW(), NOW());";
	$vQuery0=pg_query($vConn, $vSql);
	
	/*Requête permettant de récupérer l'id du CV venant d'être créé, identifiant du candidat étant clé candidate de la table.  */
	$vSql = "SELECT id_cv FROM CV WHERE candidat = '$vid_individu';";
	$vQuery1=pg_query($vConn, $vSql);
	$vResult = pg_fetch_array($vQuery1,null, PGSQL_ASSOC);
	$vid_CV = $vResult[id_cv];
/*
?>
	<table border="1">
	<tr><th>Id CV</th><th>candidat</th><th>statut</th></tr>
<?php
	//Mise dans un tableau de l'ensemble de CV existant : requête de vérification
	$vSql2 ="SELECT id_cv, candidat, statut FROM CV;";
	$vQuery=pg_query($vConn, $vSql2);
	while ($vResult2 = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
		echo "<tr>";

		echo "<td>$vResult2[0]</td>";
		echo "<td>$vResult2[1]</td>";
		echo "<td>$vResult2[2]</td>";
	
		echo "</tr>";}
	*/
	


	/*requête d'insert permettant de rajouter dans la base de donnée les informations en anglais et en français. */
	$vSql = "INSERT INTO CV_Traduit (id_CV, langue, titre, infos_complementaires) VALUES ('$vid_CV', '$vlangue1', '$vtitre1', '$vinfo1')";
	$vQuery2=pg_query($vConn, $vSql);

	$vSql = "INSERT INTO CV_Traduit (id_CV, langue, titre, infos_complementaires) VALUES ('$vid_CV', '$vlangue2', '$vtitre2', '$vinfo2')";
	$vQuery3=pg_query($vConn, $vSql);
	
	
	/*Avant de faire un commit on vérifie que tout a bien fonctionné*/
	if ($vQuery0 and $vQuery1 and $vQuery2 and $vQuery3) { 
		pg_query($vConn, "COMMIT");
		echo "Votre CV a été crée";
		echo '<p><a href="insert_langue_1.php">Continuer</a></p>';}
	else 
		echo "L'insertion  échouée. Retournez à l'acueil et recommencez!";


	
/*IF FAUT VERIFIER SI IL Y A UN DEUXIEME DESCRIPTION LANGUE DE RENTREE!!!!!!!!!*/

?>

<hr/>

</body>
</html>
	
