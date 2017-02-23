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

?>
	<h2>Petit récapitulatif des données que vous avez déjà entrées</h2>
	<table border="1">
	<tr><h3>Présentation du CV : Version en français</h3></tr>
	<tr><th>Statut du CV</th><th>Titre</th><th>Description</th></tr>

<?php

	$vSql ="SELECT CV.statut, T.titre, T.infos_complementaires FROM CV CV, CV_Traduit T WHERE CV.candidat = '$vid_individu' AND CV.id_CV = T.id_CV AND T.langue='FR';";
	$vQuery=pg_query($vConn, $vSql);
	while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
	echo "<tr>";

	echo "<td>$vResult[0]</td>";
	echo "<td>$vResult[1]</td>";
	echo "<td>$vResult[2]</td>";
	echo "</tr>";}

?>
	
	<table border="1">
	<tr><h3>Présentation du CV : Version en anglais</h3></tr>
	<tr><th>Statut du CV</th><th>Titre</th><th>Description</th></tr>

<?php

	$vSql ="SELECT CV.statut, T.titre, T.infos_complementaires FROM CV CV, CV_Traduit T WHERE CV.candidat = '$vid_individu' AND CV.id_CV = T.id_CV AND T.langue='EN';";
	$vQuery=pg_query($vConn, $vSql);
	while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
	echo "<tr>";

	echo "<td>$vResult[0]</td>";
	echo "<td>$vResult[1]</td>";
	echo "<td>$vResult[2]</td>";
	echo "</tr>";}


?>

	<table border="1">
	<tr><h3>Informations personnelles</h3></tr>
	<tr><th>Identifiant</th><th>Nom</th><th>Prenom</th><th>Mail</th><th>Mot de Passe</th><th>Telephone</th><th>URL</th></tr>

<?php
	$vSql ="SELECT I.id_individu, I.nom, I.prenom, I.mail, C.mot_de_passe, C.telephone, C.URL_web FROM Candidats C, Individus I WHERE C.id_candidat = I.id_individu AND C.id_candidat = '$vid_individu';";
	$vQuery=pg_query($vConn, $vSql);
	while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
	echo "<tr>";

	echo "<td>$vResult[0]</td>";
	echo "<td>$vResult[1]</td>";
	echo "<td>$vResult[2]</td>";
	echo "<td>$vResult[3]</td>";
	echo "<td>$vResult[4]</td>";
	echo "<td>$vResult[5]</td>";
	echo "<td>$vResult[6]</td>";
	echo "</tr>";}


?>

	<table border="1">
	<tr><h3>Niveaux de langue</h3></tr>
	<tr><th>Langue</th><th>Langue</th><th>Niveau</th></tr>

<?php

	$vSql ="SELECT L.nom_fr, L.nom_en, P.niveau_langue FROM Parler_Langue P, Langues L WHERE  '$vid_individu'= P.id_candidat AND P.id_langue = L.id;";
	$vQuery=pg_query($vConn, $vSql);
	while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
	echo "<tr>";

	echo "<td>$vResult[0]</td>";
	echo "<td>$vResult[1]</td>";
	echo "<td>$vResult[2]</td>";
	echo "</tr>";}



	$_SESSION['i'] = 1; //Variable qui pourra itérer le nombre de Compétence dans les prochaines pages
	$_SESSION['j'] = 1; //Variable qui pourra itérer le nombre de Formation dans les prochaines pages
	$_SESSION['k'] = 1; //Variable qui pourra itérer le nombre d'experiences dans les prochaines pages
	$_SESSION['l'] = 1; //Variable qui pourra itérer le nombre de poste associations dans les prochaines pages
	$_SESSION['m'] = 1; //Variable qui pourra itérer le nombre de publications dans les prochaines pages
	
	

?>

<p><a href="insert_competence_1.php">Continuer</a></p>


