<html>
     <?php
 	    include 'mise_en_page.html';
     ?>
      <body>   
	 <hr/>
         <a href="page1_projet.php"> Retourner a l'accueil ! </a>  <br>
  
        <?php  
        	
             $email=$_POST["email"];             
	     $datedebut=$_POST["datedebut"];
	     $datefin=$_POST["datefin"];
	     $etablissement=$_POST["etablissement"];
	     $pays=$_POST["pays"];
	     $ville=$_POST["ville"];

             $titre=$_POST["titre"];
             $type=$_POST["type"];
             $langue=$_POST["langue"];

             if (empty($email)){
                 die("Donner votre e-mail,s'il vous plait !");
             }
             include "connect_projet.php";
	     $vConn = fConnect();          
	     if (!($vConn)){		  
		 echo('You Done Goofed');
	     }
             
             $vSql="SELECT * FROM Individus"; 
	     $vQuery=pg_query($vConn, $vSql);
             $idIndividu=0;
	     while ($vResult = pg_fetch_array($vQuery) and $idIndividu==0 ) {
			if ($vResult[mail] == $email){
                               $idIndividu = $vResult[id_individu];				
			}
	     }

             $vSql="SELECT * FROM Suivre_Formation where id_candidat='$idIndividu'"; 
	     $vQuery=pg_query($vConn, $vSql);
             $idformation=0;	     
             while ($vResult = pg_fetch_array($vQuery)) {          
                   $idformation=$vResult[id_formation];                       
             }

             if(!empty($datedebut)){
		 $query_str = "update Formations set date_debut='$datedebut' where id_formation='$idformation' ";   			
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  

             if(!empty($datefin)){
		 $query_str = "update Formations set date_fin='$datefin' where id_formation='$idformation' ";   			
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  

             if(!empty($etablissement)){
		 $query_str = "update Formations set etablissement='$etablissement' where id_formation='$idformation' "; 	
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  


             if(!empty($pays)){
		 $query_str = "update Formations set pays='$pays' where id_formation='$idformation' "; 	
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  
            
              
             if(!empty($ville)){
		 $query_str = "update Formations set ville='$ville' where id_formation='$idformation' "; 	
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  

    
             if(!empty($titre)){
		 $query_str = "update Formations_Traduites set titre='$titre' where id_formation='$idformation' "; 	
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  

            if(!empty($type)){
		 $query_str = "update Formations_Traduites set type='$type' where id_formation='$idformation' "; 	
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  

             if(!empty($langue)){
		 $query_str = "update Formations_Traduites set langue='$langue' where id_formation='$idformation' "; 	
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  

             echo ("Vous avez fait la modification: !!!");
          ?>         
    
   </body> 
</html>

