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
    height:200%;
    border-right:1px dashed #CCC;
    /*padding:20px;
    margin-top:40px;*/
}
</style>
<h1>Etape 3 de la création de votre CV : Compétence</h1>
  <p>Veuillez remplir les champs ci-dessous</p>
<?php
	$vnb = $_POST['nb'];

	for($i=0;$i<$vnb;$i++){
		echo '(*) Compétence n°';
		echo $i+1;
		echo '<p><label>Nom</label> : <input type="text" name="nom" /></br></p>';
		echo '<p><label>Langue</label> : <select name="text" id="langue"><option value="FR">Français</option><option value="EN">English</option></select></br></br></p>';
	}
	echo '<p></br><a href="insert7.php">Continuer</a></p>';
	echo '<p><a href="insert5.php">Annuler</a></p>';


?>
<hr/>

</body>
</html>
