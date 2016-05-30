<html>
   <head>
        <title> Bienvenu ici: Modification du cadidat </title>
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
		<li><a href="select.php">Consulter les CV</a></li>
	    </ul>
	</nav>
          
      <h2>Etape de vérification : Donner votre e-mail ! </h2>
	  <form method= "post" action="Identifier_Candidat_2.php">
	     <label>Email</label> 
                 <input type="email" name="email" />
	     </br>
	     <input type="submit" value="valider" />
	  </form>
      </h2> 
   </body> 
</html>
