<html>
   <head>
        <title>Modification des informations CV </title>
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
	
        <h2>Donner les informations ce que vous voulez modifier !</h2>
  	<form id="myform" method="POST" action="ModifierCV.php">

              E-Mail*:<input type="email" name="email" size=20 ><br>
              <h4>Est-ce que vous voulez modifier 'Statut'?</h4>
              
               Statut: <select name="typ_num" id="typ_num"><br>
				<option value="des">Desactivé</option>
				<option value="conf">Confidentiel</option>
				<option value="activ">Activé</option>
	               </select>
              <h4>Est-ce que vous voulez modifier 'Date_creation'?</h4>
              Date_creation:<input type="Date" name="creation" size=20 ><br>
              <h4>Est-ce que vous voulez modifier 'Date_maj'?</h4>
              Date_maj:<input type="Date" name="Date_maj" size=20 ><br>
              <h4>Est-ce que vous voulez modifier 'les autres'?</h4>
	      Choisir:<select name="autres">
			  <option value="formation">formation</option>
			  <option value="experience">experience</option>
                          <option value="password">password</option>
		      </select><br><br>
              <input type="submit" value="valider"> 
              <input type="reset" value="refaire"> <br>

        </form>
      <hr/>
     
   </body> 
</html>
