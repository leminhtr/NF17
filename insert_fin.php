<?php session_start(); ?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 9 de la création de votre CV : Récapitulatif</h1>
	
<?php
	include 'connect_projet.php';
	$vCon = fConnect();

	$vID = $_SESSION['id_individu'];
?>
	
	
	<table border="1">
    	<tr><td width="100pt"><b>Nom</b></td> <td width="100pt"><b>Langue</b></td> </tr>
	<p>Competences</p>


<?php
	$vSQL = "SELECT C.nom AS nom, C.langue AS lang FROM Competences C JOIN Posseder_Competence PC ON C.nom = PC.nom AND C.langue = PC.langue WHERE PC.id_candidat = '$vID';";
	$vQuery = pg_query($vCon,$vSQL);
	while($vResult = pg_fetch_array($vQuery, NULL, PGSQL_ASSOC)){
		echo "<tr>";
		echo "<td>$vResult[nom]</td>";
		echo "<td>$vResult[lang]</td>";
		echo "</tr>";
	}
?>
	
	
	<table border="1">
    	<tr><td width="50pt"><b>Titre</b></td> <td width="50pt"><b>Type</b></td> <td width="50pt"><b>Langue</b></td> <td width="50pt"><b>Début</b></td> <td width="50pt"><b>Fin</b></td> <td width="50pt"><b>Etablissement</b></td> <td width="50pt"><b>Pays</b></td> <td width="50pt"><b>Ville</b></td></tr>
	<p>Formation</p>	

<?php

	$vSQL = "SELECT F.date_debut AS d_db, F.date_fin AS d_f, F.etablissement AS etab, F.pays AS pays, F.ville AS ville, FT.titre AS titre, FT.type AS type, FT.langue AS lang FROM Formations F, Formations_Traduites FT, Suivre_Formation SF WHERE  F.id_formation = FT.id_formation AND F.id_formation = SF.id_formation AND SF.id_candidat = '$vID';";

	$vQuery = pg_query($vCon,$vSQL);
	while($vResult = pg_fetch_array($vQuery, NULL, PGSQL_ASSOC)){
		echo "<tr>";
		echo "<td>$vResult[titre]</td>";
		echo "<td>$vResult[type]</td>";
		echo "<td>$vResult[lang]</td>";
		echo "<td>$vResult[d_db]</td>";
		echo "<td>$vResult[d_f]</td>";
		echo "<td>$vResult[etab]</td>";
		echo "<td>$vResult[pays]</td>";
		echo "<td>$vResult[ville]</td>";
		echo "</tr>";
	}
?>

 	


	<table border="1">
    	<tr><td width="50pt"><b>Entreprise</b></td> <td width="50pt"><b>Fonction</b></td> <td width="50pt"><b>Langue</b></td> <td width="50pt"><b>Début</b></td> <td width="50pt"><b>Fin</b></td></td></tr>
	<p>Experiences proffessionnelles</p>
<?php
	$vSQL = "SELECT E.date_debut AS d_db, E.date_fin AS d_f, E.nom_entreprise AS nom_ent, ET.fonction AS fonct, ET.langue AS lang FROM Experiences_Pro E, Experiences_Pro_Traduites ET, Avoir_Experience AE WHERE  E.id_exp_pro = ET.id_exp_pro AND E.id_exp_pro = AE.id_exp_pro AND AE.id_candidat = '$vID';";
	
	$vQuery = pg_query($vCon,$vSQL);
	while($vResult = pg_fetch_array($vQuery, NULL, PGSQL_ASSOC)){
		echo "<tr>";
		echo "<td>$vResult[nom_ent]</td>";
		echo "<td>$vResult[fonct]</td>";
		echo "<td>$vResult[lang]</td>";
		echo "<td>$vResult[d_db]</td>";
		echo "<td>$vResult[d_f]</td>";
		echo "</tr>";
	}
?>

	
 	

	
	<table border="1">
    	<tr><td width="50pt"><b>Association</b></td> <td width="50pt"><b>Langue</b></td> <td width="50pt"><b>Début</b></td> <td width="50pt"><b>Fin</b></td></td></tr>
	<p>Associations</p>
	
<?php
	$vSQL = "SELECT A.date_debut AS d_db, A.date_fin AS d_f, A.nom_asso AS nom, AT.langue AS lang FROM Postes_Associations A, Postes_Associations_Traduits AT, Participer_Association PA WHERE  A.id_asso = AT.id_asso AND a.id_asso = PA.id_asso AND PA.id_candidat = '$vID';";
	
	$vQuery = pg_query($vCon,$vSQL);
	while($vResult = pg_fetch_array($vQuery, NULL, PGSQL_ASSOC)){
		echo "<tr>";
		echo "<td>$vResult[nom]</td>";
		echo "<td>$vResult[lang]</td>";
		echo "<td>$vResult[d_db]</td>";
		echo "<td>$vResult[d_f]</td>";
		echo "</tr>";
	}
?> 

	
 	
	

	<table border="1">
	<tr><td witdh="70pt"><b>Titre</b></td> <td witdh="70pt"><b>ISBN</b></td> <td witdh="70pt"><b>Date</b></td></tr>
	<p>Publications</p>
<?php
	$vSQL = "SELECT P.titre AS titre, DP.isbn AS isbn, DP.date AS d FROM Publications P, Ecrire_Publication EP, DatePublication DP WHERE P.id_pub = EP.id_publication AND P.id_date_pub = DP.id_date_pub AND EP.id_candidat = '$vID';";

	$vQuery = pg_query($vCon,$vSQL);
	while($vResult = pg_fetch_array($vQuery, NULL, PGSQL_ASSOC)){
		echo "<tr>";
		echo "<td>$vResult[titre]</td>";
		echo "<td>$vResult[isbn]</td>";
		echo "<td>$vResult[d]</td>";
		echo "</tr>";
	}


?>

	
 	

<hr/>
</body>
</html>
