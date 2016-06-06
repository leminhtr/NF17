<html>
   <head>
       <title>Bienvenu ici les informations CV </title>
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
      <a href="page1_projet.php"> Retourner ¨¤ l'acceuil ! </a>  <br>
  
        <?php  
		
             $email=$_POST["email"];
	           $motdepass=$_POST["motdepass"];
	           $telephone=$_POST["telephone"];
	           
             if (empty($email)){
                 die("Donner votre e-mail,s'il vous plait !");
             }
             include "connect_projet.php";
	           $vConn = fConnect();          
					   if ($vConn){
					        echo('Successfully Connected: ');
					    } else {
						      echo('You Done Goofed');
					    }
             
              if(!empty($motdepass)){
		      			 $query_str = "update Individus,Candidats set mot_de_passe='{$motdepass}' where mail='{$email}' and Candidats.id_candidat=Individus.id_individu ";   
	               $query = pg_query($query_str);     
				         if(!($query)){				         
                     die ("La modification: non valable");					   
                 }
             }  
             
             if(!empty($telephone)){
		      			 $query_str = "update Individus,Candidats set telephone='{$telephone}' where mail='{$email}' and Candidats.id_candidat=Individus.id_individu ";   
	               $query = pg_query($query_str);     
				         if(!($query)){				         
                     die ("La modification: non valable");					   
                 }
             }  
             
            echo ("Vous avez fait la modification: !!!");

          ?> 
    
   </body> 
</html>

