<html>
     <?php
	    include 'mise_en_page.html';
     ?>
      <body>  
     <hr/>
     <a href="page1_projet.php"> Retourner a l'acceuil ! </a>  <br>
  
        <?php  
		
             $email=$_POST["email"];
             $vlangue=$_POST['langue'];
	     $niveau=$_POST["niveau"];
	           
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
              
              $vSql="SELECT * FROM Langues"; 
	      $vQuery=pg_query($vConn, $vSql);
	      $idLangue=0 ; 
	      while ($vResult = pg_fetch_array($vQuery)) {
		  if ($vResult[nom_fr] == $vlangue){
			$idLangue = $vResult[id];				
		  }
	      }
              

              if(!empty($niveau)){
		  $query_str = "update Parler_Langue set niveau_langue='$niveau' where id_candidat=$idIndividu and id_langue=$idLangue"; 
	          $query = pg_query($query_str);       
		   if(!($query)){				         
 		     die ("La modification: non valable");					   
 		   }
             }  
       
             echo ("Vous avez fait la modification: !!!");   
          ?> 
        
   </body> 
</html>

