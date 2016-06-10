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
	     
	     <hr/>
       <a href="page1_projet.php"> Retourner à l'acceuil ! </a>  <br>
          
       <?php  
        	
             $email=$_POST["email"];     
                 
             $nomentreprise=$_POST["nomentreprise"];    
	           $datedebut=$_POST["datedebut"];
	           $datefin=$_POST["datefin"];
	           
	           $secteuractivite=$_POST["secteuractivite"];

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

             if(!empty($nomentreprise)){
		      			 $query_str = "update Individus,Candidats,Experiences_Pro,Avoir_Experience
		      			  set nomentreprise='{$nomentreprise}' 
		      			  where mail='{$email}' 
		      			  and Candidats.id_candidat=Individus.id_individu 
		      			  and Avoir_Experience.id_candidat=Candidats.id_candidat
		      			  and Avoir_Experience.id_exp_pro=Experiences_Pro.id_exp_pro";   		  
	               $query = pg_query($query_str);     
	                if(!($query)){       
                     die ("La modification: non valable");				   
                  }
             }    
             
             if(!empty($datedebut)){
		      			 $query_str = "update Individus,Candidats,Experiences_Pro,Avoir_Experience
		      			  set date_debut='{$datedebut}' 
		      			  where mail='{$email}' 
		      			  and Candidats.id_candidat=Individus.id_individu 
		      			  and Avoir_Experience.id_candidat=Candidats.id_candidat
		      			  and Avoir_Experience.id_exp_pro=Experiences_Pro.id_exp_pro";   		  
	               $query = pg_query($query_str);    
	               if(!($query)){       
                     die ("La modification: non valable");				   
                  }    
             }      

             if(!empty($datefin)){
		      			 $query_str = "update Individus,Candidats,Experiences_Pro,Avoir_Experience
									      			  set date_fin='{$datefin}' 
									      			  where mail='{$email}' 
									      			  and Candidats.id_candidat=Individus.id_individu 
									      			  and Avoir_Experience.id_candidat=Candidats.id_candidat
									      			  and Avoir_Experience.id_exp_pro=Experiences_Pro.id_exp_pro";   		  
	               $query = pg_query($query_str);     
				         if(!($query)){       
                     die ("La modification: non valable");				   
                  }
             }    
             
             if(!empty($secteuractivite)){
		      			  $query_str = "update Individus,Candidats,Experiences_Pro,Avoir_Experience,SecteurEntreprise
									      			  set secteur_activite='{$secteuractivite}' 
									      			  where mail='{$email}' 
									      			  and Candidats.id_candidat=Individus.id_individu 
									      			  and Avoir_Experience.id_candidat=Candidats.id_candidat
									      			  and Avoir_Experience.id_exp_pro=Experiences_Pro.id_exp_pro
									      			  and Experiences_Pro.nom_entreprise=SecteurEntreprise.nom_entreprise";   		  
	               $query = pg_query($query_str);     
				         if(!($query)){       
                     die ("La modification: non valable");				   
                  }
             }    
             echo ("Vous avez fait la modification: !!!");
          ?>         
            
   </body> 
</html>
