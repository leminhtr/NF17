<html>
       <?php
	    include 'mise_en_page.html';
       ?>
       <body>

        <hr/>
        <a href="page1_projet.php"> Retourner a l'accueil ! </a>  <br>
  
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
	     if (!($vConn)){
		  die('You Done Goofed');
	     }
             
              $vSql="SELECT * FROM Individus"; 
	      $vQuery=pg_query($vConn, $vSql);
              $idIndividu=0;
	      while ($vResult = pg_fetch_array($vQuery) and $vverif==0 ) {
			if ($vResult[mail] == $email){
                                $idIndividu = $vResult[id_individu];				
			}
		}

              $vSql="SELECT * FROM Participer_Association where id_candidat='$idIndividu'"; 
	      $vQuery=pg_query($vConn, $vSql);
              $idasso=0;	     
	      while ($vResult = pg_fetch_array($vQuery)) {              
                     $idasso=$vResult[id_asso];                       
              }
              
               if(!empty($nomasso)){
		    $query_str = "update Postes_Associations set nom_asso='$nomasso' where id_asso='$idasso' ";   			     $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
              }  

              if(!empty($datedebut)){
		    $query_str = "update Postes_Associations set date_debut='$datedebut' where id_asso='$idasso' ";   			     $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
              }  
        
              if(!empty($datefin)){
		    $query_str = "update Postes_Associations set date_fin='$datefin' where id_asso='$idasso' ";   			     $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
              }  

              if(!empty($langue)){
		    $query_str = "update Postes_Associations_Traduits set langue='$langue' where id_asso='$idasso' ";   			     $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
              }  
 
              if(!empty($description)){
		    $query_str = "update Postes_Associations_Traduits set description='$description' where id_asso='$idasso' ";   			     $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
              }  

             echo ("Vous avez fait la modification: !!!");
          ?>        
    
   </body> 
</html>

