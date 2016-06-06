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
		<p>Espace R¨¦f¨¦rents</p>
		</br>
		<li><a href="select.php">Consulter les CV</a></li>
	    </ul>
	</nav>
      <hr/>
      
        <form id="myform" method="POST" action="ModificationInformation_2.php">
        	
              <h3>Identification du candidat! <br>   
              E-Mail*:<input type="email" name="email" size=20 ><br>  
                    
              <h4>Est-ce que vous voulez modifier le mot_de_passe? <br>  
              Mot_de_passe:<input type="text" name="motdepass" size=20><br>
              
               <h4>Est-ce que vous voulez modifier le telephone ? <br>  
              Telephone:<input type="text" name="telephone" size=15><br><br>
              
              <input type="submit" value="valider"> 
              <input type="reset" value="refaire"> <br>
       </form>
     
     <hr/>
            
   </body> 
</html>
