<html>
      <?php
	    include 'mise_en_page.html';
      ?>
       <body> 
	    <hr/>
      <a href="page1_projet.php"> Retourner a l'acceuil ! </a>  <br>
  
        <?php  
		
             $email=$_POST["email"];
	     $motdepass=$_POST["motdepass"];
	     $telephone=$_POST["telephone"];
	           
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
	      $idIndividu=0 ; 
	      while ($vResult = pg_fetch_array($vQuery)) {
		  if ($vResult[mail] == $email){
			$idIndividu = $vResult[id_individu];				
		  }
	      }
       
              if(!empty($motdepass)){
		     $query_str = "update Candidats set mot_de_passe='$motdepass' where id_candidat='$idIndividu' ";   
	             $query = pg_query($query_str);     
		     if(!($query)){				         
                        die ("La modification: non valable");					   
                     }
              }  
             
             if(!empty($telephone)){
		     $query_str = "update Candidats set telephone='$telephone' where id_candidat='$idIndividu' ";
	             $query = pg_query($query_str);     
		     if(!($query)){				         
                       die ("La modification: non valable");					   
                     }
              }  
             
            echo ("Vous avez fait la modification: !!!");
 
          ?> 
    
   </body> 
</html>

