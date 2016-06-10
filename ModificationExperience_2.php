<html>
      <?php
	    include 'mise_en_page.html';
      ?>
       <body> 
	     
       <hr/>
       <a href="page1_projet.php"> Retourner à l'acceuil ! </a>  <br>
          
       <?php  
        	
             $email=$_POST["email"];              
             $nomentreprise=$_POST["nomentreprise"];    
	     $datedebut=$_POST["datedebut"];
	     $datefin=$_POST["datefin"];	           
	     $fonction=$_POST["fonction"];
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

             $vSql="SELECT * FROM Avoir_Experience where id_candidat='$idIndividu'"; 
             $vQuery=pg_query($vConn, $vSql);
             $idexpre=0;	     
             while ($vResult = pg_fetch_array($vQuery)) {
                   $idexpre = $vResult[id_exp_pro];                       
             }

             if(!empty($datedebut)){
		$query_str = "update Experiences_Pro set date_debut='$datedebut' where id_exp_pro='$idexpre' and nom_entreprise='$nomentreprise' "; 		
                $query = pg_query($query_str);   
	          if(!($query)){				         
                    die ("La modification: non valable");		   
                }		         
             }  

             if(!empty($datefin)){
		 $query_str = "update Experiences_Pro set date_fin='$datefin' where id_exp_pro='$idexpre' and nom_entreprise='$nomentreprise' "; 		
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  

             if(!empty($fonction)){
		 $query_str = "update Experiences_Pro_Traduites set fonction='$fonction' where id_exp_pro='$idexpre' "; 		
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  

            if(!empty($langue)){
		 $query_str = "update Experiences_Pro_Traduites set langue='$langue' where id_exp_pro='$idexpre' "; 		
                 $query = pg_query($query_str);   
	            if(!($query)){				         
                     die ("La modification: non valable");		   
                  }		         
             }  

             echo ("Vous avez fait la modification: !!!");
          ?>         
            
   </body> 
</html>
