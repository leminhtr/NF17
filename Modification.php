<html>
   <head>
        <title> Modification des informations CV </title>
	<meta charset = "UTF-8">
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
	
	
        <h2> Modification des informations CV </h2>
        <p>  Donner votre e-mail: c'est obigatoire !</p>
  	<form id="myform" method="POST" action="menuCV.php">
              E-Mail*:<input type="email" name="email" size=20><br>
              <input type="submit" value="valider"> 
              <input type="reset" value="refaire"> <br>
        </form>

      <hr/>
     
   </body> 
</html>
