<html>
<head>
	<title>INSCRIPTION A UN SITE DE CANDIDATURE</title>
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
	<li><a href="select.html">Consulter les CV</a></li>
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
<h1>Créez votre CV</h1>
<h2>Etape de vérification : un seul CV n'est possible par personne</h2>
  <form method= "post" action="insert2.php">
     <label>Email</label> : <input type="email" name="email" />
     </br>
     <input type="submit" value="valider" />
     </p>
  </form>
</body>
</html>
