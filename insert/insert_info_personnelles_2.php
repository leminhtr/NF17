<?php session_start(); //Création d'une session pour pouvoir garder l'id tout le long de l'inscription ?> 
<html>
 
<?php
include 'mise_en_page.html';
?>
  <h1>Etape 1 de la création de votre CV : informations personnels</h1>

<?php
	/*Concetion à la base de donnée*/
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
	
	/*Création d'un individu dans la table. On ne s'occupe pas de l'id, qui est clée artificielle, car elle est crée automatiquement grace au type SERIAL de la table Individus*/
	$vSql1 = "INSERT INTO Individus (nom, prenom, mail) VALUES ('$vnom', '$vprenom', '$vemail')";
	$vQuery=pg_query($vConn, $vSql1);
	
	/*Récupération de l'id de cet individu en utilisant la clée candidate mail*/
	$vSql2 = "SELECT id_individu FROM Individus WHERE mail = '$vemail'";
	$vQuery2=pg_query($vConn, $vSql2);
	$vResult = pg_fetch_array($vQuery2);
	$vid_individu = $vResult[id_individu];

	/*Stockage dans la session de l'id de l'individu. Nous utilisons une session plutôt qu'un POST car nous allons en avoir besoin pour de nombreuses pages. En effet toutes les classes de l'UML sont reliées par une clée étrangère à candidat qui est la classe centrale. */
	$_SESSION['id_individu'] = $vid_individu;

	/*Création d'un identifiant qui doit être unique*/
	$identifiant = $vnom.$vprenom.$vid_individu;/*IL FAUT : fonction vérifiant l'unicité*/
	
	/*Création du candidat, ce candidat est avant tout un individu. Il y a héritage*/
	$vSql3 = "INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type, URL_web, type_web) VALUES ('$vid_individu', '$identifiant', '$vMDP', '$vtel', '$vtypnum', '$vURL', '$vtypweb')";
	$vQuery3=pg_query($vConn, $vSql3);


	if ($vQuery and $vQuery3) { 
		$vQuery=pg_query($vConn, "COMMIT");
		echo "Vos première données ont été bien enregistrée";
		echo '<p><a href="insert_presentation_CV_1.php">Continuer</a></p>';}

?>


<hr/>

</body>
</html>


