<?php session_start(); //Création d'une session pour pouvoir garder l'id tout le long de l'inscription ?> 
<html>
 
<?php
include 'mise_en_page.html';
?>
  <h1>Etape 1 de la création de votre CV : informations personnels</h1>

<?php
	include "connect_projet.php";
	$vConn = fConnect();
  /* Récupération des variables passées par le fomulaire */
	$vnom=$_POST['nom'];
	$vprenom=$_POST['prenom'];
	$vemail=$_POST['email'];
	$vMDP=$_POST['motdepasse'];
	$vtel=$_POST['tel'];
	$vtypnum=$_POST['typ_num'];
	$vURL=$_POST['url'];
	$vtypweb=$_POST['typ_web'];

	
	//echo var_dump($_POST);

	


	pg_query($vConn, "BEGIN TRANSACTION");
	
	$vSql1 = "INSERT INTO Individus (nom, prenom, mail) VALUES ('$vnom', '$vprenom', '$vemail')";
	$vQuery=pg_query($vConn, $vSql1);
	

	$vSql2 = "SELECT id_individu FROM Individus WHERE mail = '$vemail'";
	$vQuery2=pg_query($vConn, $vSql2);
	$vResult = pg_fetch_array($vQuery2);
	$vid_individu = $vResult[id_individu];
	$_SESSION['id_individu'] = $vid_individu;

	$identifiant = $vnom.$vprenom.$vid_individu;/*IL FAUT : fonction vérifiant l'unicité*/
	
	$vSql3 = "INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type, URL_web, type_web) VALUES ('$vid_individu', '$identifiant', '$vMDP', '$vtel', '$vtypnum', '$vURL', '$vtypweb')";
	$vQuery3=pg_query($vConn, $vSql3);


	if ($vQuery and $vQuery3) { 
		$vQuery=pg_query($vConn, "COMMIT");
		echo "Vos première données ont été bien enregistrée";
		echo '<p><a href="insert3_3.php">Continuer</a></p>';}




?>



<hr/>

</body>
</html>


