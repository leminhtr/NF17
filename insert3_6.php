<?php session_start(); ?>

<html>
<?php
include 'mise_en_page.php';
?>
  <h1>Etape 2 de la création de votre CV : informations principales de votre CV</h1>

<?php
	include "connect_projet.php";
	$vConn = fConnect();

	$vid_individu = $_SESSION['id_individu'];
	$vid_CV = $_SESSION['id_CV'];

	$vlangue1=$_POST['langue1'];
	$vtitre1=$_POST['titre1'];
	$vinfo1=$_POST['infos_complementaires1'];
	$vlangue2=$_POST['langue2'];
	$vtitre2=$_POST['titre2'];
	$vinfo2=$_POST['infos_complementaires2'];


	echo " affichage de ce putain d'identifiant : $vid_CV";



	$vSql = "INSERT INTO CV_Traduit (id_CV, langue, titre, infos_complementaires) VALUES ('$vid_CV', '$vlangue1', '$vtitre1', '$vinfo1')";
	$vQuery=pg_query($vConn, $vSql);

	$vSql = "INSERT INTO CV_Traduit (id_CV, langue, titre, infos_complementaires) VALUES ('$vid_CV', '$vlangue2', '$vtitre2', '$vinfo2')";
	$vQuery=pg_query($vConn, $vSql);
	
	pg_query($vConn, "COMMIT");
	echo "Les insertes ont fonctionnés";
	
/*IF FAUT VERIFIER SI IL Y A UN DEUXIEME DESCRIPTION LANGUE DE RENTREE!!!!!!!!!*/

?>

<hr/>

</body>
</html>
