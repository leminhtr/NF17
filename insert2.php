<html>
<head>
  <title>Inscription Soutenance NF17</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<nav>
    <ul>
        <li><a href="page1_projet.php">Accueil</a></li>
	</br>
	<p>Espace Candidats</p>
	</br>
        <li><a href="insert.php">Ajouter votre CV</a></li>
        <li><a href="check.php">Modifier votre CV</a></li>
	</br>
	<p>Espace Référents</p>
	</br>
	<li><a href="select.php">Consulter les CV</a></li>
    </ul>
</nav>
<style>
nav{
    float:left;
    width:25%;
    height:100%;
    border-right:1px dashed #CCC;
    /*padding:20px;
    margin-top:40px;*/
}
</style>
  <h1>Vérifions d'abord que vous n'existez pas dans notre base</h1>
<?php
	include "connect_projet.php";
	$vConn = fConnect();
  /* Récupération des variables passées par le fomulaire */
	$vEmail=$_POST['email'];
  /* Inscription */

	$vSql="SELECT I.mail FROM Candidats C, Individus I WHERE C.id_candidat=I.id_individu;"; 
	$vQuery=pg_query($vConn, $vSql);
	$vverif = 0; 
	while ($vResult = pg_fetch_array($vQuery) and $vverif==0 ) {
		if ($vResult == $vEmail){
			$vverif = 1;
			echo "Vous avez déjà crée un CV dans notre base de donnée, vous ne pouvez donc pas en créer un nouveau";}
			/*COMMENT ON PEUT STOPER ICI SI PAS CORRECT???????????*/
	}
	echo "Vous n'avez jamais créé de CV chez nous. Créez-le maintenant!";
	if ($vverif == 0)
		{echo '<p><a href="insert3.php">Continuer</a></p>';}

?>

<hr/>

</body>
</html>