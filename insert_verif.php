<html>
<?php
include 'mise_en_page.html';
?>
  <h1>Vérifions d'abord que vous n'existez pas dans notre base</h1>
<?php
  /*Connection à la base de donnée*/
	include "connect_projet.php";
	$vConn = fConnect();
  /* Récupération des variables passées par le fomulaire */
	$vEmail=$_POST['email'];
  /* Verification que cet email (qui est clé candidate) n'appartient à aucune personne de notre base. Si c'est le cas alors elle pourra créer un CV*/

	$vSql="SELECT mail FROM Individus ;"; 
	$vQuery=pg_query($vConn, $vSql);
	$vverif = 0; 
	while ($vResult = pg_fetch_array($vQuery) and $vverif==0 ) {
		if ($vResult[mail] == $vEmail){
			$vverif = 1;
			echo "Vous avez déjà crée un CV dans notre base de donnée, vous ne pouvez donc pas en créer un nouveau";}
	}
	
	if ($vverif == 0) {
		/*Si cet email n'existe pas on le récupère pour ne pas avoir à le rentrer une seconde fois. Pour cela on utilise en formulaire. Cependant afin de pouvoir récupérer la variable $vEmail il faut inclure ce formulaire dans un echo du code php*/
		echo "Vous n'avez jamais créé de CV chez nous. Créez-le maintenant!";
		echo "<form action='insert_info_personnelles_1.php' method='post'>
			<input type='hidden' name='email' value='$vEmail'>
			<input type='submit' > 
			</form>";}

?>


<hr/>

</body>
</html>
