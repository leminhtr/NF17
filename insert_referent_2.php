<?php session_start(); /*Permet de passer de page en page l'identifiant artificiel du candidat créant son CV*/ ?>

<html>
<?php
include 'mise_en_page.html';
?>

<h1>Etape 4 de la création de votre CV : choix d'un référent</h1>

<?php
	/*Concetion à la base de donnée*/
	include "connect_projet.php";
	$vConn = fConnect();
	/*Récupération de l'identifiant du candidat conservé dans la session*/
	$vid_individu = $_SESSION['id_individu'];
	/*Récupération de la variable passée en formulaire*/
	$vid_referent = $_POST['id'];

	/*Insertion dans la table posseder_referent du liant unifiant le nouveau candidat à son référent préalablement choisit*/
	$vSql = "INSERT INTO Posseder_Referent (id_candidat, id_referent) VALUES ('$vid_individu', '$vid_referent')";
	pg_query($vConn, $vSql);

	/*Requête renvoyant le mail, nom et prénom du référent choisit*/
	$vSql ="SELECT nom, prenom, mail FROM Individus WHERE id_individu = '$vid_referent';";
	$vQuery=pg_query($vConn, $vSql);
	$vResult = pg_fetch_array($vQuery);
	echo "Voici le nom, prénom et email du référent que vous avez choisit : $vResult[nom] $vResult[prenom] : $vResult[mail] ";

	/* //affichage des liaisons existante entre candidat et référent
	$vSql ="SELECT id_candidat, id_referent FROM Posseder_Referent;";
	$vQuery=pg_query($vConn, $vSql);
	while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
		echo "<tr>";

		echo "<td>$vResult[0]</td>";
		echo "<td>$vResult[1]</td>";

		echo "</tr>";}*/

	$_SESSION['i'] = 1; //Variable qui pourra itérer le nombre de Compétence dans les prochaines pages
	$_SESSION['j'] = 1; //Variable qui pourra itérer le nombre de Formation dans les prochaines pages
	
	echo '<p><a href="insert5.php">Continuer</a></p>';

	

?>

