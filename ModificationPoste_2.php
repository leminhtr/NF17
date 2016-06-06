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
	           $nomasso=$_POST["nomasso"];
	           $datedebut=$_POST["datedebut"];
	           $datefin=$_POST["datefin"];	           
	           $langue=$_POST["langue"];
	           $description=$_POST["description"];
	           
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
             
              if(!empty($datedebut)){
		      			 $query_str = "update Individus,Candidats,Postes_Associations,Participer_Association
		      			               set date_debut='{$datedebut}'
		      			               where mail='{$email}' 
		      			               and Candidats.id_candidat=Individus.id_individu 
		      			               and Participer_Associationset.id_asso=Postes_Associations.id_asso
		      			               and Participer_Associationset.id_candidat=Candidats.id_candidat";   
	               $query = pg_query($query_str);   
	                if(!($query)){				         
                     die ("La modification: non valable");		   
                  }
     				         
             }  
               
             
              if(!empty($datefin)){
		      			 $query_str = "update Individus,Candidats,Postes_Associations,Participer_Association 
		      			               set date_fin='{$datefin}'
		      			               where mail='{$email}' 
		      			               and Candidats.id_candidat=Individus.id_individu 
		      			               and Participer_Associationset.id_asso=Postes_Associations.id_asso
		      			               and Participer_Associationset.id_candidat=Candidats.id_candidat";   
	               $query = pg_query($query_str);    
	                $query = pg_query($query_str);   
	                if(!($query)){				         
                     die ("La modification: non valable");		   
                  } 				        
             }                  
             
             if(!empty($langue)){
		      			 $query_str = "update Individus,Candidats,Postes_Associations,Participer_Association,Postes_Associations_Traduits
		      			               set langue='{$langue}'
		      			               where mail='{$email}' and Candidats.id_candidat=Individus.id_individu 
		      			               and Participer_Associationset.id_asso=Postes_Associations.id_asso
		      			               and Participer_Associationset.id_candidat=Candidats.id_candidat
		      			               and Postes_Associations_Traduits.id_asso=Postes_Associations.id_asso";   
	               $query = pg_query($query_str);     
	                $query = pg_query($query_str);   
	                if(!($query)){				         
                     die ("La modification: non valable");		   
                  }				        
             }  
             
             if(!empty($description)){
		      			 $query_str = "update Individus,Candidats,Postes_Associations,Participer_Association,Postes_Associations_Traduits
		      			               set description='{$description}'
		      			               where mail='{$email}' and Candidats.id_candidat=Individus.id_individu 
		      			               and Participer_Associationset.id_asso=Postes_Associations.id_asso
		      			               and Participer_Associationset.id_candidat=Candidats.id_candidat
		      			               and Postes_Associations_Traduits.id_asso=Postes_Associations.id_asso";   
	               $query = pg_query($query_str); 
	                $query = pg_query($query_str);   
	                if(!($query)){				         
                     die ("La modification: non valable");		   
                  }    				         
             }  
             echo ("Vous avez fait la modification: !!!");
          ?>        
    
   </body> 
</html>

