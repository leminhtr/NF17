<?php session_start(); ?>

<html>
<?php
include 'mise_en_page.html';
?>
  <h1>Etape 2 de la création de votre CV : informations principales de votre CV</h1>

<?php
	include "connect_projet.php";
	$vConn = fConnect();

	$vid_individu = $_SESSION['id_individu'];

	$sstatut=$_POST['statut'];
	$vlangue1=$_POST['langue1'];
	$vtitre1=$_POST['titre1'];
	$vinfo1=$_POST['infos_complementaires1'];
	$vlangue2=$_POST['langue2'];
	$vtitre2=$_POST['titre2'];
	$vinfo2=$_POST['infos_complementaires2'];




	pg_query($vConn, "BEGIN TRANSACTION");
		
	$vSql = "INSERT INTO CV (candidat, statut, date_creation, date_maj) VALUES ('$vid_individu', '$sstatut', NOW(), NOW())";
	$vQuery=pg_query($vConn, $vSql);
	

	$vSql = "SELECT id_cv FROM CV WHERE candidat = '$vid_individu'";
	$vQuery1=pg_query($vConn, $vSql);
	$vResult = pg_fetch_array($vQuery1,null, PGSQL_ASSOC);
	$vid_CV = $vResult[id_cv];

?>
	<table border="1">
	<tr><th>Id CV</th><th>candidat</th><th>statut</th></tr>
<?php
	$vSql2 ="SELECT id_cv, candidat, statut FROM CV;";
	$vQuery=pg_query($vConn, $vSql2);
	while ($vResult2 = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
		echo "<tr>";

		echo "<td>$vResult2[id_cv]</td>";
		echo "<td>$vResult2[candidat]</td>";
		echo "<td>$vResult2[statut]</td>";
	
		echo "</tr>";}
	



	$vSql = "INSERT INTO CV_Traduit (id_CV, langue, titre, infos_complementaires) VALUES ('$vid_CV', '$vlangue1', '$vtitre1', '$vinfo1')";
	$vQuery=pg_query($vConn, $vSql);

	$vSql = "INSERT INTO CV_Traduit (id_CV, langue, titre, infos_complementaires) VALUES ('$vid_CV', '$vlangue2', '$vtitre2', '$vinfo2')";
	$vQuery=pg_query($vConn, $vSql);
	
	pg_query($vConn, "COMMIT");

?>
	<table border="1">
	<tr><th>cv traduit</th><th>langue</th><th>titre</th><th>info</th></tr>
<?php
	$vSql2 ="SELECT * FROM CV_traduit;";
	$vQuery=pg_query($vConn, $vSql2);
	while ($vResult2 = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
		echo "<tr>";

		echo "<td>$vResult2[id_cv]</td>";
		echo "<td>$vResult2[langue]</td>";
		echo "<td>$vResult2[titre]</td>";
		echo "<td>$vResult2[infos_complementaires]</td>";
	
		echo "</tr>";}


	if ($vQuery1) { 
		pg_query($vConn, "COMMIT");
		echo "Votre CV a été crée";
		echo '<p><a href="insert5.php">Continuer</a></p>';}


	
/*IF FAUT VERIFIER SI IL Y A UN DEUXIEME DESCRIPTION LANGUE DE RENTREE!!!!!!!!!*/

?>

<hr/>

</body>
</html>
	
