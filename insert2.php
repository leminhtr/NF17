<html>
<?php
include 'mise_en_page.php';
             ?>
  <h1>Vérifions d'abord que vous n'existez pas dans notre base</h1>
<?php
	include "connect_projet.php";
	$vConn = fConnect();
  /* Récupération des variables passées par le fomulaire */
	$vEmail=$_POST['email'];
  /* Verification */

	$vSql="SELECT mail FROM Individus ;"; 
	$vQuery=pg_query($vConn, $vSql);
	$vverif = 0; 
	while ($vResult = pg_fetch_array($vQuery) and $vverif==0 ) {
		if ($vResult[mail] == $vEmail){
			$vverif = 1;
			echo "Vous avez déjà crée un CV dans notre base de donnée, vous ne pouvez donc pas en créer un nouveau";}
	}
	
	if ($vverif == 0) {
		echo "Vous n'avez jamais créé de CV chez nous. Créez-le maintenant!";
		echo '<p><a href="insert3.php">Continuer</a></p>';}


?>

<hr/>

</body>
</html>