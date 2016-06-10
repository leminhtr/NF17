<html>
<?php
	include 'mise_en_page.html';
?>
<section>
	<h1>Bienvenue dans notre site de gestion de CV</h1>
	<p>
		Si vous êtes candidat vous allez pouvoir ajouter votre CV, il doit être unique, ou bien gérer votre CV déjà créer. Seulement les administrateurs de ce site on l'accès à toutes les informations.
	</p>
</section>


<?php
/*Connexion à la BDD*/
include "connect_projet.php";
$vConn = fConnect();

$query_sql_candidats="SELECT count(*)
 					  FROM candidats;";

$query_candidats=pg_query($vConn,$query_sql_candidats);

$nb_candidats_site=pg_fetch_result($query_candidats,0,0);

echo"<h1>Vous êtes actuellement $nb_candidats_site à nous faire confiance !<h1>";


?>

</body> 
</html>
